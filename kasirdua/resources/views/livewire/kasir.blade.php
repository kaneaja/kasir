<div>
     <section class="container-fluid py-5 px-0 px-md-5">
        
        <div class="row g-4">
            <div class="col-md-7">
                <h2 class="text-dark fw-bold mb-4">Kasir</h2>

                <ul class="nav nav-pills gap-1 pb-3 mb-4 border-bottom">
                    <li class="nav-item">
                        <a class="nav-link {{ $category == 'semua'? 'active' : ''}} " aria-current="page" href=".">Semua</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $category == 'Makanan'? 'active' : ''}}" wire:click="filter('Makanan')" href="#">Makanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $category == 'Minuman'? 'active' : ''}}" wire:click="filter('Minuman')" href="#">Minuman</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $category == 'Snack'? 'active' : ''}}" wire:click="filter('Snack')" href="#">Snack</a>
                    </li>
                </ul>

                <div class="row g-3">
                    @foreach ($menus as $item)
                    <div class="col-6 col-lg-4">
                        <div class="card" style="cursor: pointer;" wire:click="addToCart({{$item->id}})">
                            <div class="card-body p-4 w-100" >
                                <img src="{{ url('storage/'.$item->image)}}" class="d-block mx-auto object-fit-cover" width="90" height="80" alt="Dish 01">
                                <h4 class="card-title mt-4 mb-2">{{$item->name}}</h4>
                                <div
                                    class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-1">
                                    <p class="mb-0 text-secondary fs-7">{{$item->category->name}}</p>
                                    <p class="mb-0 text-secondary fs-7"><strong>{{$item->stock}}</strong></p><br/>
                                    <p class="mb-0 text-primary fw-semibold">Rp{{number_format($item->price,  0, ',', '.')}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <!-- MULAI DELETE -->
                    <!-- BATAS DELETE -->
                </div>
            </div>
            <div class="col-md-5">
                <div class="card border-0">
                    @if ($transaction != null)
                        <div class="card-body px-4">
                            <h4 class="text-dark fw-semibold mb-3">Order #{{$transaction->id}}</h4>
                            @foreach ($transaction->details as $item)
                            <div class="row align-items-center g-3 mt-3">
                                <div class="col-3 col-lg-2">
                                    <img src="{{url('storage/' . $item->menu->image)}}" alt="" class="rounded-2">
                                </div>
                                <div class="col-9 col-lg-4">
                                    <p class="mb-0 fw-semibold text-dark">{{$item->menu->name}}</p>
                                    <p class="mb-0 fw-semibold text-secondary fs-7">{{number_format($item->price)}}</p>
                                </div>
                                <div class="col-4 col-lg-2">
                                    <div class="d-flex align-items-center gap-2">
                                        <button wire:click= "quantityMinus({{ $item->id }})" class="btn btn-sm btn-quantity rounded-circle">
                                            <i class="bx bx-minus"></i>
                                        </button>
                                        <p class="mb-0 text-dark">
                                            {{$item->quantity}}
                                        </p>
                                        <button wire:click= "addToCart ({{ $item->menu->id }})"  class="btn btn-sm btn-quantity rounded-circle">
                                            <i class="bx bx-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-3">
                                    <p class="mb-0 text-dark fw-bold text-end">Rp {{number_format($item->quantity * $item->price)}}</p>
                                </div>
                                <div class="col-2 col-lg-1">
                                    <button wire:click= "deleteDetail({{ $item->id }})" class="btn btn-sm btn-light btn-delete" type="button"><i
                                            class="bx bx-trash"></i></button>
                                </div>
                            </div>  
                            @endforeach

                            <hr class="mt-5 mb-4">

                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <p class="mb-0 text-secondary">Subtotal</p>
                                <p class="mb-0 text-dark fw-bold">Rp {{number_format($transaction->subtotal)}}</p>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <p class="mb-0 text-secondary">Pajak 10%</p>
                                <p class="mb-0 text-dark fw-bold">Rp {{number_format ($transaction->subtotal * ($transaction->pax/100))}}</p>
                            </div>

                            <hr class="my-4" style="border-style: dashed;">

                            <div class="d-flex align-items-center justify-content-between mb-5">
                                <p class="mb-0 text-secondary">Total</p>
                                <p class="mb-0 text-dark fw-bold fs-5">Rp {{number_format($transaction->subtotal + ($transaction->subtotal * ($transaction->pax/100)) )}}</p>
                            </div>

                            <button class="btn btn-primary rounded-3 d-block py-3 w-100" type="button"
                                data-bs-toggle="modal" data-bs-target="#checkoutModal">
                                Checkout
                            </button>
                        </div>
                        
                    @else
                        <div class="card-body">
                            <p>masih belum ada transaksi apa pun</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="modal fade" id="checkoutModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title">Checkout</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit= "checkout">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="customer_name"><i class="bx bx-user"></i></span>
                                <input type="text" class="form-control" wire:model="customer_name" id="name">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="nominalInput">Rp.</span>
                                <input type="text" class="form-control" wire:model="pay">
                            </div>
                            <button class="btn btn-primary w-100" type="submit">Proses</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>