@extends('layouts.app')

@section('content')
    <form action="{{ route('bill.store') }}" id="form-checkout" method="post">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        {{-- <h4 class="card-title">Zero Configuration</h4>
                    <h6 class="card-subtitle">DataTables has most features enabled by default, so all you
                        need to do to use it with your own tables is to call the construction
                        function:<code> $().DataTable();</code>. You can refer full documentation from here
                        <a href="https://datatables.net/">Datatables</a>
                    </h6> --}}
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered no-wrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th>Quantity</th>
                                        <th>SubTotal</th>
                                    </tr>
                                </thead>
                                <tbody id="product-lists">
                                    @csrf
                                    @foreach ($carts as $cart)
                                        <tr class="product-list">
                                            <input type="hidden" name="cart_id[]" value="{{ $cart->id }}">
                                            <input type="hidden" name="product_id[]" value="{{ $cart->product_id }}">
                                            <input type="hidden" class="price" name="price[]"
                                                value="{{ $cart->product->price }}">

                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if ($cart->product->image != null)
                                                    <img src="{{ asset('storage/' . $cart->product->image) }}"
                                                        alt="" class="img-fluid" width="50">
                                                @endif
                                            </td>
                                            <td>{{ $cart->product->name }}</td>
                                            <td>{{ $cart->product->price }}</td>
                                            <td>{{ $cart->product->stock }}</td>
                                            <td style="width: 10px">
                                                <input type="number" class="form-control quantity"
                                                    max="{{ $cart->product->stock }}" name="quantity[]"
                                                    value="{{ $cart->quantity }}">
                                            </td>
                                            <td>
                                                <input type="hidden" name="subtotal[]" value="">
                                                <span class="subtotal">0</span>
                                            </td>
                                        </tr>
                                    @endforeach

                                    <input type="hidden" name="total">

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="6">Total</th>
                                        <th><span id="total">0</span></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- sample modal content -->
        <div id="modal-checkout" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="add-staffLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="add-staffLabel">Checkout</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="text-dark" for="pwd">Payment Method</label>
                            <select name="payment_method"
                                class="form-control @error('payment_method') is-invalid @enderror">
                                @foreach ($payment_methods as $payment_method)
                                    <option value="{{ $payment_method->id }}">{{ $payment_method->account_number }} |
                                        {{ $payment_method->bank_name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('payment_method')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                        <button type="submit" form="form-checkout" class="btn btn-primary">Checkout</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </form>
@endsection

@section('title')
    Data Keranjang
@endsection

@section('customize-element')
    <button class="btn btn-md btn-primary btn-rounded" data-toggle="modal" data-target="#modal-checkout">
        Pilih Pembayaran
    </button>
@endsection

@section('breadcrumb')
    <ol class="breadcrumb m-0 p-0">
        <li class="breadcrumb-item">
            <a href="index.html">Application</a>
        </li>
        <li class="breadcrumb-item">
            <a href="index.html">Data Keranjang</a>
        </li>
    </ol>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            hitungTotal();

            function hitungTotal() {
                var total = 0;
                $('.product-list').each(function(index, element) {
                    var quantity = parseInt($(element).find($('[name="quantity[]"]')).val())
                    var price = parseInt($(element).find($('[name="price[]"]')).val())
                    var subtotal = Math.ceil(quantity * price);

                    $(element).find($('.subtotal')).html(subtotal);
                    $(element).find($('[name="subtotal[]"]')).val(subtotal);

                    total += subtotal;
                });

                $('[name="total"]').val(total);
                $('#total').html(total);
                // console.log(total);
            }

            $('#product-lists').on('change', '.quantity', function() {
                hitungTotal();
            })
        });
    </script>
@endpush
