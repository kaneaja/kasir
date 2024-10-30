@extends('layouts.admin')
    
@section('content')
       <div class="flex-centerbetween mb-4">
            <h2 class="text-dark fw-bold mb-0">Tambah Kasir</h2>
        </div>
        <div class="card border-0">
            <div class="card-body">
                <form action="{{route('cashiers.update', $users->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name">Nama</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $users->name) }}" autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="username">username</label>
                        <input type="text" name="username" class="form-control" id="email" value="{{ old('username', $users->username) }}">
                    </div>
                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password">
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-primary" type="submit">
                            <i class="bx bx-save"></i> Simpan Baru
                        </button>
                        <a href="{{url('kasir')}}" class="btn btn-danger">
                            <i class="bx bx-arrow-back"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
@endsection