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
                        <table id="table-staff" class="table table-striped table-bordered no-wrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->staff->phone_number ?? '-' }}</td>
                                        <td>{!! $user->status = 1
                                            ? '<span class="badge badge-info">Active</span>'
                                            : '<span class="badge badge-danger">Not Active</span>' !!}
                                        </td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Action Button">
                                                <button type="button" class="btn btn-warning btn-edit"
                                                    data-id="{{ $user->id }}" data-name="{{ $user->name }}"
                                                    data-email="{{ $user->email }}"
                                                    data-phone_number="{{ $user->phone_number }}"><i
                                                        class="ti-pencil"></i></button>
                                                <button type="button" class="btn btn-danger btn-delete"
                                                    data-id="{{ $user->id }}"><i class="ti-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Status</th>
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
    <div id="add-staff" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="add-staffLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="add-staffLabel">Tambah Staff</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form id="form-add-staff" method="post" action="{{ route('staff.store') }}">
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

                        <div class="form-group">
                            <label class="text-dark" for="pwd">Email</label>
                            <input class="form-control @error('email') is-invalid @enderror" type="email" name="email"
                                placeholder="enter your email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="text-dark" for="pwd">Phone Number</label>
                            <input class="form-control @error('phone_number') is-invalid @enderror" type="text"
                                name="phone_number" placeholder="enter your phone number">

                            @error('phone_number')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="text-dark" for="pwd">Password</label>
                            <input class="form-control" type="password" name="password"
                                placeholder="Default Password : password" readonly>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <button type="subimt" form="form-add-staff" class="btn btn-primary">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- sample modal content -->
    <div id="edit-staff" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="edit-staffLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="edit-staffLabel">Update Staff</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form id="form-edit-staff" method="post">
                        @csrf
                        @method('PUT')

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

                        <div class="form-group">
                            <label class="text-dark" for="pwd">Email</label>
                            <input class="form-control @error('email') is-invalid @enderror" type="email"
                                name="email" placeholder="enter your email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="text-dark" for="pwd">Phone Number</label>
                            <input class="form-control @error('phone_number') is-invalid @enderror" type="text"
                                name="phone_number" placeholder="enter your phone_number">

                            @error('phone_number')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="text-dark" for="pwd">Password</label>
                            <input class="form-control" type="password" name="password"
                                placeholder="Default Password : password" readonly>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <button type="subimt" form="form-edit-staff" class="btn btn-primary">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div id="delete-staff" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="delete-staffLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h4 class="modal-title" id="delete-staffLabel">Update Staff</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form id="form-delete-staff" method="post">
                        @csrf
                        @method('DELETE')
                        <p>Apakah anda yakin ingin menghapus data ini ?</p>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <button type="subimt" form="form-delete-staff" class="btn btn-danger">Yes, Delete</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@endsection

@section('title')
    Data Staff
@endsection

@section('customize-element')
    <button class="btn btn-md btn-primary btn-rounded" data-toggle="modal" data-target="#add-staff">
        Tambah Data
    </button>
@endsection

@section('breadcrumb')
    <ol class="breadcrumb m-0 p-0">
        <li class="breadcrumb-item">
            <a href="index.html">Master Data</a>
        </li>
        <li class="breadcrumb-item">
            <a href="index.html">Data Staff</a>
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
        $('#table-staff').DataTable();

        $(document).ready(function() {
            $('#table-staff').on('click', '.btn-edit', function() {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var email = $(this).data('email');
                var phone_number = $(this).data('phone_number');

                $('#form-edit-staff [name="name"]').val(name);
                $('#form-edit-staff [name="email"]').val(email);
                $('#form-edit-staff [name="phone_number"]').val(phone_number);

                $('#form-edit-staff').attr('action', "{{ url('staff/update') }}/" + id);

                $('#edit-staff').modal('show');
            })

            $('#table-staff').on('click', '.btn-delete', function() {
                var id = $(this).data('id');

                $('#form-delete-staff').attr('action', "{{ url('staff/delete') }}/" + id);

                $('#delete-staff').modal('show');
            })
        });
    </script>
@endpush
