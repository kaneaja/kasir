@extends('layouts.admin')

@section('content')
    <section class="container-fluid px-1 px-lg-5">
        <div class="flex-centerbetween mb-4">
            <h2 class="text-dark fw-bold mb-0">Tambah Menu</h2>
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
                <form action="{{ route('menu.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name">Nama Menu</label>
                        <input type="text" name="name" class="form-control" id="name" autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="category">Kategori</label>
                        <select name="category_id" id="category_id" class="form-select mb-2">
                            <option value="" selected disabled>Pilih Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="">harga</label>
                        <div class="d-flex align-item-center gap-2">
                            Rp
                                <input type="text" name="priceDisplay" id="priceDisplay" class="w-100 form-control">
                                <input type="hidden" name="price" id="price">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="">stok</label>
                        <input type="text" name="stockDisplay" id="stockDisplay" class="w-100 form-control">
                        <input type="hidden" name="stock" id="stock">
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
        };
        // 
        document.addEventListener('DOMContentLoaded', function(){
        const priceDisplayInput = document.querySelector('#priceDisplay');
        const priceInput = document.querySelector('#price');

        function formatPriceInput() {
            const value = this.value.replace(/[^0-9]/g, '');
            priceInput.value = value;
            this.value = value ? new Intl.NumberFormat('id-ID').format(value) : '';
        }

        priceDisplayInput.addEventListener('input', formatPriceInput);
       });

       document.addEventListener('DOMContentLoaded', function(){
        const stockDisplayInput = document.querySelector('#stockDisplay');
        const stockInput = document.querySelector('#stock');

        function formatStockInput() {
            const value = this.value.replace(/[^0-9]/g, '');
            stockInput.value = value;
            this.value = value ? new Intl.NumberFormat('id-ID').format(value) : '';
        }

        stockDisplayInput.addEventListener('input', formatStockInput);
       });
    </script>
@endsection