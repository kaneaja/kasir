<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::with('category')->get();
        return view('pages.admin.menu.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('pages.admin.menu.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);
        $image = $this->processImage($request);

        Menu::create([
            'name'=>$request->name,
            'price'=>$request->price,
            'stock'=>$request->stock,
            'image' => $image,
            'category_id'=> $request->category_id,
        ]);

        return redirect()->route('menu.index');
    }

    private function processImage($request){
        $newFileName = null;
        
        if($request->hasFile('image')){
            $extension = $request->file('image')->getClientOriginalExtension();
            $newFileName = $request->name . '-' . now()->timestamp . '.' . $extension;
            $request->file('image')->storeAs('images', $newFileName, 'public');
        }

        return $newFileName ? 'images/' . $newFileName : null;
    }

        
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $menu = Menu::findOrFail($id);
        $categories = Category::all();

        return view('pages.admin.menu.edit', compact('menu', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        $menu = Menu::findOrFail($id);
        $image = $menu->image;

        if ($request->hasFile('image')){
            $image = $this->processImage($request);
        }

        $menu->update([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $image,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('menu.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // $menu = Menu::finOrFail($id);
        // $menu->delete();

        // return redirect()->route('menu.index');

        $menu = Menu::where('id', $id)
        ->delete();
        return redirect()
        ->route('menu.index')
        ->with('message', 'user deleted successfully');
    }
}
