@extends('layouts.admin')
    
@section('content')
        <div class="flex-centerbetween mb-4">
            <h2 class="text-dark fw-bold mb-0">Kasir</h2>
            <a href="{{route('cashiers.create')}}" class="btn btn-primary">
                <i class="bx bx-plus"></i> Tambah Kasir
            </a>
        </div>
        <div class="card border-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>username</th>
                                <th>Total Penjualan</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr class="align-middle">
                                <td>{{$loop->iteration}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->username}}</td>
                                <td>{{$user->transactions->count()}}</td>
                                <td>
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{route('cashiers.edit', $user->id)}}" class="btn btn-warning btn-sm py-1 px-3 rounded-1 text-white">
                                            <i class="bx bx-edit"></i> Edit
                                        </a>
                                           <form action="{{route('cashiers.destroy', $user->id)}}">
                                            @csrf
                                            @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm py-1 px-3 rounded-1">
                                                    <i class="bx bx-trash"></i> hapus
                                                </button>
                                           </form>
                                        </button>
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