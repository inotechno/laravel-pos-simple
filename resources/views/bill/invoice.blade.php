@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Detail Invoice</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table no-wrap">
                            <thead>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Sub Total</th>
                            </thead>
                            <tbody>
                                @foreach ($bill->details as $detail)
                                    <tr>
                                        <td>{{ $detail->product->name }}</td>
                                        <td>{{ $detail->price }}</td>
                                        <td>{{ $detail->quantity }}</td>
                                        <td>{{ $detail->sub_total }}</td>
                                    </tr>
                                @endforeach
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th colspan="3">Total</th>
                                    <th><span id="total">{{ $bill->total }}</span></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    @hasrole('customer')
                        <p class="font-weight-bold font-italic h6 text-warning">* Silahkan lakukan pembayaran ke nomor rekening
                            yang tertera
                            dan
                            lakukan
                            konfirmasi jika pembayaran
                            sudah dibayarkan.</p>
                    @endhasrole
                </div>
            </div>
        </div>

        <div class="col-md">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Detail Pembayaran</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <h5>Nomor Rekening</h5>
                            <h6>{{ $bill->bank_account->account_number }}</h6>
                        </li>
                        <li class="list-group-item">
                            <h5>Bank Name</h5>
                            <h6>{{ $bill->bank_account->bank_name }}</h6>
                        </li>
                        <li class="list-group-item">
                            <h5>Atas Nama</h5>
                            <h6>{{ $bill->bank_account->account_holder_name }}</h6>
                        </li>
                        <li class="list-group-item">
                            <h5>Total</h5>
                            <h6>{{ $bill->total }}</h6>
                        </li>
                        <li class="list-group-item">
                            <h5>Status</h5>
                            @if ($bill->status == 'Unpaid')
                                <span class="badge badge-warning">{{ $bill->status }}</span>
                            @elseif ($bill->status == 'Paid')
                                <span class="badge badge-success">{{ $bill->status }}</span>
                            @else
                                <span class="badge badge-danger">{{ $bill->status }}</span>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- sample modal content -->
    <div id="modal-confirmation" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="add-staffLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="add-staffLabel">Konfirmasi Pembayaran</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form id="form-confirmation" enctype="multipart/form-data" method="post"
                        action="{{ route('payment.confirmation', $bill->order_number) }}">
                        @csrf
                        <div class="form-group">
                            <label class="text-dark" for="pwd">Upload Bukti</label>
                            <input type="file" name="image_transfer"
                                class="form-control @error('image_transfer') is-invalid @enderror"">

                            @error('image_transfer')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <button type="submit" form="form-confirmation" class="btn btn-primary">Confirmation</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@section('title')
    Invoice
@endsection

@section('customize-element')
    @hasrole('customer')
        @if ($bill->status == 'Unpaid')
            <button class="btn btn-md btn-primary btn-rounded" data-toggle="modal" data-target="#modal-confirmation">
                Konfirmasi Pembayaran
            </button>
        @endif
    @endhasrole
@endsection

@section('breadcrumb')
    <ol class="breadcrumb m-0 p-0">
        <li class="breadcrumb-item">
            <a href="index.html">Application</a>
        </li>
        <li class="breadcrumb-item">
            <a href="index.html">Invoice</a>
        </li>
    </ol>
@endsection
