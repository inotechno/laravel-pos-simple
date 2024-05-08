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
                    <form action="{{ route('report.index') }}" method="get">
                        {{-- @csrf --}}
                        <div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <select name="staff_id" class="form-control">
                                        <option value="">Filter Pegawai</option>
                                        @foreach ($staffs as $staff)
                                            <option value="{{ $staff->id }}">{{ $staff->user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md">
                                <div class="form-group">
                                    <select name="customer_id" class="form-control">
                                        <option value="">Filter Customer</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group">
                                    <button class="btn btn-rounded btn-primary" type="submit">Filter</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered no-wrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Order Number</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>Bank Account</th>
                                    <th>Bank Name</th>
                                    <th>Staff</th>
                                    <th>Status</th>
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
                                        <td>{{ $bill->staff->user->name }}</td>
                                        <td>
                                            @if ($bill->status == 'Unpaid')
                                                <span class="badge badge-warning">{{ $bill->status }}</span>
                                            @elseif ($bill->status == 'Paid')
                                                <span class="badge badge-success">{{ $bill->status }}</span>
                                            @else
                                                <span class="badge badge-danger">{{ $bill->status }}</span>
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
@endsection

@section('title')
    Report Transaction
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
            <a href="index.html">Report</a>
        </li>
    </ol>
@endsection
