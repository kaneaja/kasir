@extends('layouts.admin')

@section('content')
    <section class="container-fluid py-5 px-1 px-lg-5">
        <div class="flex-centerbetween mb-4">
            <h2 class="text-dark fw-bold mb-0">Edit Menu</h2>
        </div>
        <div class="card border-0">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('menu.update', $menu->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name">Nama Menu</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{ $menu->name }}"
                            autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="category">Kategori</label>
                        <select name="category_id" id="category_id" class="form-select mb-2">
                            <option value="" selected disabled>Pilih Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $menu->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="mb-3">
                            <label for="price">Harga Produk</label>
                            <input type="number" name="price" id="price" class="form-control"
                                value="{{ $menu->price }}">
                        </div>
                        <div class="mb-3">
                            <label for="stock">Stock Produk</label>
                            <input type="number" name="stock" id="stock" class="form-control"
                                value="{{ $menu->stock }}">
                        </div>
                        <div class="mb-3">
                            <label for="imageInput">Gambar Produk</label>
                            <input type="file" name="image" id="imageInput" class="form-control"
                                placeholder="image here..." onchange="previewImage()">
                            <span class="text-danger d-block mt-1">{{ $errors->first('imageInput') }}</span>
                            <img class="mt-4" id="imagePreview" src="#" alt="Preview"
                                style="display: none; max-width: 100%; max-height: 200px">
                        </div>
                        <div class="d-flex gap-2">
                            <button class="btn btn-primary" type="submit">
                                <i class="bx bx-save"></i> Simpan Baru
                            </button>
                            <a href="{{ route('menu.index') }}" class="btn btn-light">
                                <i class="bx bx-arrow-back"></i> Kembali
                            </a>
                        </div>
                </form>
            </div>
        </div>
    </section>

    <script>
        function previewImage() {
            const input = document.getElementById('imageInput');
            const preview = document.getElementById('imagePreview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection