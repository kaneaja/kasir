@extends('layouts.admin')
    
@section('content')
    <div class="flex-centerbetween mb-4">
        <h2 class="text-dark fw-bold mb-0">Pendapatan</h2>
    </div>

    <div class="card border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kode Pesanan</th>
                            <th>ID Kasir</th>
                            <th>Nama Pelanggan</th>
                            <th>Item</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $grandTotal = 0;
                        @endphp
                        @foreach ($incomes as $item)
                            @php
                                $subtotal = $item->subtotal;
                                $tax = $subtotal * 0.1; // Pajak 10%
                                $total = $subtotal + $tax;
                            @endphp
                            <tr class="align-middle">
                                <td>{{ $loop->iteration }}</td>
                                <td>#{{ $item->id }}</td>
                                <td>{{ $item->cashier_id ? $item->cashier_id : 'Tidak Ada Kasir' }}</td>
                                <td>{{ $item->customer_name }}</td>
                                <td>{{ $item->details->count() }} Item</td>
                                <td>Rp. {{ number_format($total) }}</td>
                                <td>
                                    <div class="d-flex justify-content-end gap-2">
                                        <button type="button" class="btn btn-primary btn-sm py-1 px-3 rounded-1"
                                            data-bs-toggle="modal" data-bs-target="#detail{{ $item->id }}">
                                            <i class="bx bx-info-circle"></i> Detail Pesanan
                                        </button>
                                        <a href="{{ route('kasir.print', $item->id) }}" target="_blank"
                                            class="btn btn-success btn-sm py-1 px-3 rounded-1">
                                            <i class="bx bx-printer"></i> Cetak
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal Detail Pesanan -->
                            <div class="modal fade" id="detail{{ $item->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header border-0">
                                            <h5 class="modal-title">Detail Pesanan</h5>
                                            <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            @php
                                                $modalSubtotal = 0;
                                            @endphp
                                            @foreach ($item->details as $detail)
                                                <p class="mb-1 text-secondary text-uppercase fw-medium fs-7">Detail Produk</p>
                                                <div class="row mt-2">
                                                    <div class="col-7">
                                                        <p class="mb-0 text-dark fw-semibold">{{ $detail->menu->name }}</p>
                                                        <p class="mb-0 text-secondary fs-7">Rp. {{ number_format($detail->price) }}</p>
                                                    </div>
                                                    <div class="col-5">
                                                        <p class="mb-0 text-dark text-end fw-semibold">
                                                            Rp. {{ number_format($detail->price * $detail->quantity) }}
                                                        </p>
                                                        <p class="mb-0 text-secondary text-end fs-7">{{ $detail->quantity }}x</p>
                                                    </div>
                                                </div>
                                                @php
                                                    $modalSubtotal += $detail->price * $detail->quantity;
                                                @endphp
                                            @endforeach

                                            @php
                                                $modalTax = $modalSubtotal * 0.1; // Pajak 10%
                                                $modalTotal = $modalSubtotal + $modalTax;
                                            @endphp

                                            <hr class="my-4" style="border-style: dashed;">
                                            <div class="d-flex align-items-center justify-content-between mt-2">
                                                <p class="mb-0 text-secondary">Subtotal</p>
                                                <p class="mb-0 text-dark fw-semibold">Rp. {{ number_format($modalSubtotal) }}</p>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-2">
                                                <p class="mb-0 text-secondary">Pajak (10%)</p>
                                                <p class="mb-0 text-dark fw-semibold">Rp. {{ number_format($modalTax) }}</p>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-2">
                                                <p class="mb-0 text-secondary">Total</p>
                                                <p class="mb-0 text-dark fw-semibold">Rp. {{ number_format($modalTotal) }}</p>
                                            </div>
                                            <hr class="my-4" style="border-style: dashed;">
                                            <div class="d-flex align-items-center justify-content-between mt-2">
                                                <p class="mb-0 text-secondary">Cash</p>
                                                <p class="mb-0 text-dark fw-semibold">
                                                    Rp. {{ number_format($modalTotal) }}
                                                </p> 
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-2">
                                                <p class="mb-0 text-secondary">Kembali</p>
                                                <p class="mb-0 text-dark fw-semibold">Rp. {{ number_format($item->return ?? 0) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @php
                                $grandTotal += $total;
                            @endphp
                        @endforeach
                    </tbody>

                    <tfoot>
                        <tr>
                            <td colspan="5" class="text-end"><strong>Total:</strong></td>
                            <td><strong>Rp. {{ number_format($grandTotal) }}</strong></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
