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
                        <table id="table-bill" class="table table-striped table-bordered no-wrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Order Number</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>Bank Account</th>
                                    <th>Bank Name</th>
                                    <th>Status</th>

                                    <th>
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bills as $bill)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $bill->order_number }}</td>
                                        <td>{{ $bill->date }}</td>
                                        <td>{{ $bill->total ?? '-' }}</td>
                                        <td>{{ $bill->bank_account->account_number }}</td>
                                        <td>{{ $bill->bank_account->bank_name }}</td>
                                        <td>
                                            @if ($bill->status == 'Unpaid')
                                                <span class="badge badge-warning">{{ $bill->status }}</span>
                                            @elseif ($bill->status == 'Paid')
                                                <span class="badge badge-success">{{ $bill->status }}</span>
                                            @else
                                                <span class="badge badge-danger">{{ $bill->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($bill->image_transfer != null)
                                                <a class="btn btn-info btn-sm" target="_blank"
                                                    href="{{ asset('storage/' . $bill->image_transfer) }}"><span
                                                        class="fas fa-camera"></span></a>

                                                <a class="btn btn-secondary btn-sm"
                                                    href="{{ route('bill.invoice', $bill->order_number) }}"><span
                                                        class="fas fa-eye"></span></a>

                                                @hasrole('staff')
                                                    @if ($bill->status == 'Unpaid')
                                                        <button class="btn btn-success btn-sm btn-validation"
                                                            data-id="{{ $bill->id }}"><span
                                                                class="fas fa-check"></span></button>
                                                    @endif
                                                @endhasrole
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modal-validation" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="delete-billLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h4 class="modal-title" id="delete-billLabel">Validasi Payment</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form id="form-validasi-payment" method="post">
                        @csrf
                        <input type="hidden" name="id">
                        <p>Apakah anda yakin ingin memvalidasi pembayaran ini ?</p>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <button type="subimt" form="form-validasi-payment" class="btn btn-success">Yes, Validation</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@endsection

@section('title')
    Data Transaksi
@endsection

@section('customize-element')
    {{-- <button class="btn btn-md btn-primary btn-rounded" data-toggle="modal" data-target="#add-bill">
        Tambah Data
    </button> --}}
@endsection

@section('breadcrumb')
    <ol class="breadcrumb m-0 p-0">
        <li class="breadcrumb-item">
            <a href="index.html">Transaction</a>
        </li>
        <li class="breadcrumb-item">
            <a href="index.html">Billing Lists</a>
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
        $('#table-bill').DataTable();

        $(document).ready(function() {
            $('#table-bill').on('click', '.btn-validation', function() {
                var id = $(this).data('id');

                $('#form-validasi-payment').attr('action', "{{ url('bill/validation') }}/" + id);
                $('#modal-validation').modal('show');
            })

        });
    </script>
@endpush
