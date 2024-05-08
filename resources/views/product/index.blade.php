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
                                    <th>Created At</th>
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
                                        <td>{{ $product->created_at }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Action Button">
                                                <button type="button" class="btn btn-warning btn-edit"
                                                    data-id="{{ $product->id }}" data-name="{{ $product->name }}"
                                                    data-price="{{ intval($product->price) }}"
                                                    data-stock="{{ $product->stock }}"
                                                    data-description="{{ $product->description }}"
                                                    data-image="{{ asset('storage/' . $product->image) }}"><i
                                                        class="ti-pencil"></i></button>
                                                <button type="button" class="btn btn-danger btn-delete"
                                                    data-id="{{ $product->id }}"><i class="ti-trash"></i></button>
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
                                    <th>Created At</th>
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
    <div id="add-product" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="add-productLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="add-productLabel">Tambah Product</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form id="form-add-product" method="post" action="{{ route('product.store') }}"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label class="text-dark" for="pwd">Name</label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name"
                                placeholder="enter your name">

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <label class="text-dark" for="pwd">Price</label>
                                    <input class="form-control @error('price') is-invalid @enderror" type="number"
                                        name="price" placeholder="enter your price">

                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md">
                                <div class="form-group">
                                    <label class="text-dark" for="pwd">Stock</label>
                                    <input class="form-control @error('stock') is-invalid @enderror" type="number"
                                        name="stock" placeholder="enter your stock">

                                    @error('stock')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="text-dark" for="pwd">Image</label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file" name="image"
                                placeholder="enter your image">

                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="text-dark" for="pwd">Description</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" name="description"
                                id="" cols="30" rows="5"></textarea>

                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <button type="subimt" form="form-add-product" class="btn btn-primary">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- sample modal content -->
    <div id="edit-product" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="edit-productLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="edit-productLabel">Update Product</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form id="form-edit-product" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <img id="img-preview" src="" alt="" class="img-fluid">
                        </div>

                        <div class="form-group">
                            <label class="text-dark" for="pwd">Name</label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name"
                                placeholder="enter your name">

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <label class="text-dark" for="pwd">Price</label>
                                    <input class="form-control @error('price') is-invalid @enderror" type="number"
                                        name="price" placeholder="enter your price">

                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md">
                                <div class="form-group">
                                    <label class="text-dark" for="pwd">Stock</label>
                                    <input class="form-control @error('stock') is-invalid @enderror" type="number"
                                        name="stock" placeholder="enter your stock">

                                    @error('stock')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="text-dark" for="pwd">Image</label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file"
                                name="image" placeholder="enter your image">

                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="text-dark" for="pwd">Description</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" name="description"
                                id="" cols="30" rows="5"></textarea>

                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <button type="subimt" form="form-edit-product" class="btn btn-primary">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div id="delete-product" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="delete-productLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h4 class="modal-title" id="delete-productLabel">Update Product</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form id="form-delete-product" method="post">
                        @csrf
                        @method('DELETE')
                        <p>Apakah anda yakin ingin menghapus data ini ?</p>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <button type="subimt" form="form-delete-product" class="btn btn-danger">Yes, Delete</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@endsection

@section('title')
    Data Product
@endsection

@section('customize-element')
    <button class="btn btn-md btn-primary btn-rounded" data-toggle="modal" data-target="#add-product">
        Tambah Data
    </button>
@endsection

@section('breadcrumb')
    <ol class="breadcrumb m-0 p-0">
        <li class="breadcrumb-item">
            <a href="index.html">Master Data</a>
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
            $('#table-product').on('click', '.btn-edit', function() {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var stock = $(this).data('stock');
                var price = $(this).data('price');
                var image = $(this).data('image');
                var description = $(this).data('description');

                $('#form-edit-product [name="name"]').val(name);
                $('#form-edit-product [name="stock"]').val(stock);
                $('#form-edit-product [name="price"]').val(price);
                $('#form-edit-product [name="description"]').html(description);
                $('#form-edit-product #img-preview').attr('src', image);


                $('#form-edit-product').attr('action', "{{ url('product/update') }}/" + id);

                $('#edit-product').modal('show');
            })

            $('#table-product').on('click', '.btn-delete', function() {
                var id = $(this).data('id');

                $('#form-delete-product').attr('action', "{{ url('product/delete') }}/" + id);

                $('#delete-product').modal('show');
            })
        });
    </script>
@endpush
