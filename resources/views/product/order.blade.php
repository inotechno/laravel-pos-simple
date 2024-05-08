@extends('layouts.app')

@section('content')
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
                        <table id="table-product" class="table table-striped table-bordered no-wrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Description</th>
                                    <th>Stock</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if ($product->image != null)
                                                <img src="{{ asset('storage/' . $product->image) }}" alt=""
                                                    class="img-fluid">
                                            @endif
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->limit() }}</td>
                                        <td>{{ $product->stock }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Action Button">
                                                <button type="button" class="btn btn-warning btn-order"
                                                    data-id="{{ $product->id }}" data-name="{{ $product->name }}"
                                                    data-price="{{ intval($product->price) }}"
                                                    data-stock="{{ $product->stock }}"
                                                    data-description="{{ $product->description }}"
                                                    data-image="{{ asset('storage/' . $product->image) }}"><i
                                                        class="ti-shopping-cart"></i></button>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Description</th>
                                    <th>Stock</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- sample modal content -->
    <div id="order-product" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="order-productLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="order-productLabel">Tambah Product</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form id="form-order-product" method="post" action="{{ route('cart.store') }}">
                        @csrf
                        {{-- <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid" alt=""> --}}

                        <input type="hidden" name="product_id">

                        <div class="form-group">
                            <label class="text-dark" for="pwd">Name</label>
                            <input class="form-control" type="text" readonly id="name">
                        </div>

                        <div class="form-group">
                            <label class="text-dark" for="pwd">Stock</label>
                            <input class="form-control" type="text" id="stock" readonly>
                        </div>

                        <div class="form-group">
                            <label class="text-dark" for="pwd">Stock</label>
                            <input class="form-control" type="text" id="price" readonly>
                        </div>

                        <div class="form-group">
                            <label class="text-dark" for="pwd">Quantity</label>
                            <input class="form-control" type="text" name="quantity">
                        </div>

                        <div class="form-group">
                            <p id="description"></p>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <button type="subimt" form="form-order-product" class="btn btn-primary">Checkout</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@section('title')
    Data Product
@endsection

@section('customize-element')
    <a class="btn btn-md btn-primary btn-rounded" href="{{ route('cart.index') }}">
        Keranjang
    </a>
@endsection

@section('breadcrumb')
    <ol class="breadcrumb m-0 p-0">
        <li class="breadcrumb-item">
            <a href="index.html">Application</a>
        </li>
        <li class="breadcrumb-item">
            <a href="index.html">Data Product</a>
        </li>
    </ol>
@endsection

@push('css')
    <link href="{{ asset('assets/extra-libs/c3/c3.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/chartist/dist/chartist.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
@endpush

@push('js')
    <script src="{{ asset('assets/extra-libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script>
        /*************************************************************************************/
        // -->Template Name: Bootstrap Press Admin
        // -->Author: Themedesigner
        // -->Email: niravjoshi87@gmail.com
        // -->File: datatable_basic_init
        /*************************************************************************************/

        /****************************************
         *       Basic Table                   *
         ****************************************/
        $('#table-product').DataTable();

        $(document).ready(function() {
            $('#table-product').on('click', '.btn-order', function() {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var stock = $(this).data('stock');
                var price = $(this).data('price');
                var image = $(this).data('image');
                var description = $(this).data('description');

                $('#form-order-product [name="product_id"]').val(id);
                $('#form-order-product #name').val(name);
                $('#form-order-product #stock').val(stock);
                $('#form-order-product #price').val(price);
                $('#form-order-product #description').html(description);
                $('#form-order-product #img-preview').attr('src', image);

                $('#order-product').modal('show');
            })
        });
    </script>
@endpush
