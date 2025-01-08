<?php

namespace App\Livewire;

use App\Models\Menu;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Kasir extends Component
{
    public $menus, $category = 'semua', $transaction , $customer_name, $pay, $total = 0;



    public function filter($category)
    {
        if ($category == 'semua') {
            $this->menus = Menu::all();
            $this->category = 'semua';
        } else {
            $this->menus = Menu::whereHas('category', function ($q) use ($category) {
                $q->where('name', $category);
            })->get();
            $this->category = $category;
        }
    }

    public function addToCart($id)
    {
        $menu = Menu::find($id);
        if($menu->stock > 0){

            $transaction = Transaction::where('status', 'Cart')->where('cashier_id', Auth::user()->id)->first();
    
            if ($transaction == null) {
                $lastTransaction = Transaction::create([
                    'customer_name' => 'no name',
                    'cashier_id' => Auth::user()->id,
                    'subtotal' => $menu->price,
                    'pax' => 10
                ]);
                TransactionDetail::create([
                    'transaction_id' => $lastTransaction->id,
                    'menu_id' => $menu->id,
                    'quantity' => 1,
                    'price' => $menu->price
                ]);
                $menu->update([
                    'stock'=>$menu->stock -1
                ]);
            } else {
                $transactionDetails = $transaction->details->where('menu_id',$id)->first();
              
                if($transactionDetails){
                    $transactionDetails->update([
                        'quantity' => $transactionDetails->quantity + 1
                    ]);
                }else{
                    TransactionDetail::create([
                        'transaction_id' => $transaction->id,
                        'menu_id' => $menu->id,
                        'quantity' => 1,
                        'price' => $menu->price
                    ]);
                }
                $transaction->update([
                    'subtotal' => $transaction->subtotal + $menu->price
                ]);
                $menu->update([
                    'stock' => $menu->stock - 1
                ]);
            }
        }

        
        $this->mount();
    }

    public function quantityMinus($id){
        $transactionDetails = TransactionDetail::find($id);
        $transactionDetails->transaction->update([
            'subtotal' => $transactionDetails->transaction->subtotal - $transactionDetails->price
        ]);
        $transactionDetails->menu->update([
            'stock' => $transactionDetails->menu->stock + 1
        ]);

        if ($transactionDetails->quantity == 1) {
            if($transactionDetails->transaction-> details->sum('quantity') == 1){
                $transactionDetails->transaction->delete();
            }
            $transactionDetails->delete();
        } else {
            $transactionDetails->update([
                'quantity' => $transactionDetails->quantity - 1
            ]);
        }
        $this->mount();
    }

    public function deleteDetail($id){
        $transactionDetails = TransactionDetail::find($id);
        $transactionDetails->transaction->update([
            'subtotal' => $transactionDetails->transaction->subtotal - ($transactionDetails->price * $transactionDetails->quantity)
        ]);
        $transactionDetails->menu->update([
            'stock' => $transactionDetails->menu->stock + $transactionDetails->quantity
        ]);
        if ($transactionDetails->transaction->details->count() == 1) {
            $transactionDetails->transaction->delete();
        }
        $transactionDetails->delete();
        $this->mount();

    }

    public function checkout(){
        $transaction = $this->transaction;

        foreach ($transaction->details as $item){
            $this->total += $item->price * $item->quantity; 
        }

        $this->total += ($transaction->subtotal * ($transaction->pax / 100));

        $transaction->update([
            'customer_name'=> $this->customer_name,
            'total'=> $this->total,
            'pay'=> $this->pay,
            'return'=>$this->pay - $this->total,
            'status'=> 'waiting'
        ]);
        
        return $this->redirectRoute( 'kasir.success', $transaction->id, navigate:true );
    }

    public function mount()
    {
        $this->menus = Menu::all();
        $this->transaction = Transaction::where('status', 'cart')->where('cashier_id', Auth::user()->id)->first();
    }
    public function render()
    {
        return view('livewire.kasir');
    }
}
