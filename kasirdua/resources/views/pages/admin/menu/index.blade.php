@extends('layouts.admin')
    
@section('content')
        <div class="flex-centerbetween mb-4">
            <h2 class="text-dark fw-bold mb-0">Menu</h2>
            <a href="{{route('menu.create')}}" class="btn btn-primary">
                <i class="bx bx-plus"></i> Tambah Menu
            </a>
        </div>
        <div class="card border-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Gambar</th>
                                <th>Nama Menu</th>
                                <th>Kategori Menu</th>
                                <th>Harga</th>
                                <th>Stock</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($menus as $menu)
                            <tr class="align-middle">
                                <td><img src="{{ asset('storage/' . $menu->image)}}" alt="" class="rounded object-fit-cover" width="40"></td>
                                <td>{{$menu->name}}</td>
                                <td>{{$menu->category->name}}</td>
                                <td>Rp{{number_format($menu->price,  0, ',', '.')}}</td>
                                <td>{{number_format($menu->stock, 0, ',', '.')}}</td>
                                <td>
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{route('menu.edit', $menu->id)}}" class="btn btn-warning btn-sm py-1 px-3 rounded-1 text-white">
                                            <i class="bx bx-edit"></i> Edit
                                        </a>
                                           <form action="{{route('menu.destroy', $menu->id)}}">
                                            @csrf
                                            @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm py-1 px-3 rounded-1">
                                                    <i class="bx bx-trash"></i> hapus
                                                </button>
                                           </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        
@endsection