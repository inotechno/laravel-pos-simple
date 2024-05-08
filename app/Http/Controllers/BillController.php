<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Cart;
use App\Models\BillDetail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BillController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->hasRole('customer')) {
            $bills = Bill::where('customer_id', auth()->user()->customer->id)->get();
        } else {
            $bills = Bill::all();
        }

        // dd($bills);
        return view('bill.index', compact('bills'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'product_id.*' => 'required',
            'quantity.*' => 'required|integer'
        ]);

        try {
            $order_number = date('YmdHis');
            $bill = Bill::create([
                'order_number' => $order_number,
                'customer_id' => auth()->user()->customer->id,
                'date' => date('Y-m-d'),
                'total' => $request->total,
                'bank_account_id' => $request->payment_method,
                'status' => 'Unpaid'
            ]);

            $cart = Cart::with('product')->whereIn('id', $request->cart_id)->get();

            foreach ($cart as $key => $crt) {
                $crt->status_checkout = true;
                $crt->save();

                $crt->product->update(['stock' => $crt->product->stock - $crt->quantity]);

                BillDetail::create([
                    'bill_id' => $bill->id,
                    'product_id' => $request->product_id[$key],
                    'price' => $request->price[$key],
                    'quantity' => $request->quantity[$key],
                    'sub_total' => $request->subtotal[$key]
                ]);
            }

            $request->session()->flash('success', 'Checkout berhasil, silahkan lakukan pembayaran dan upload bukti!');
            return redirect()->route('bill.invoice', $order_number);
        } catch (\Throwable $th) {
            $request->session()->flash('error', $th->getMessage());
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($order_number)
    {
        $bill = Bill::with('details', 'bank_account')->where('order_number', $order_number)->first();
        return view('bill.invoice', compact('bill'));
    }

    public function payment_confirm(Request $request, $order_number)
    {
        // dd($request);

        $request->validate([
            'image_transfer' => 'required',
        ]);

        try {
            $bill = Bill::where('order_number', $order_number)->first();
            if ($bill) {
                $uuid = Str::uuid();

                $extension = $request->image_transfer->getClientOriginalExtension();
                $filenameSimpan = $uuid . '_' . time() . '.' . $extension;
                $path = $request->image_transfer->storeAs('image_transfers', $filenameSimpan, 'public');

                $bill->update([
                    'image_transfer' => $path
                ]);

                $request->session()->flash('success', 'Konfirmasi berhasil, silahkan tunggu staff konfirmasi pembayaran!');
                return redirect()->route('bill.invoice', $order_number);
            }

            $request->session()->flash('error', 'Invoice Not Found!');
            return redirect()->route('bill.index');
        } catch (\Throwable $th) {
            $request->session()->flash('error', $th->getMessage());
            return back();
        }
    }

    public function payment_validation(Request $request, $id)
    {
        try {
            $bill = Bill::find($id);

            if ($bill) {
                $bill->update([
                    'status' => "Paid",
                    'staff_id' => auth()->user()->staff->id
                ]);

                $request->session()->flash('success', 'Validasi berhasil, Status berhasil diubah!');
                return redirect()->route('bill.index');
            }

            $request->session()->flash('error', 'Invoice Not Found!');
            return redirect()->route('bill.index');
        } catch (\Throwable $th) {
            $request->session()->flash('error', $th->getMessage());
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
