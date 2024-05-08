<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $payment_methods = BankAccount::all();
        $carts = Cart::where('customer_id', auth()->user()->customer->id)->where('status_checkout', false)->get();
        return view('cart.index', compact('carts', 'payment_methods'));
    }

    public function store(Request $request)
    {
        // dd($request);

        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required|integer'
        ]);
        // dd(auth()->user()->customer->id);
        try {
            Cart::create([
                'product_id' => $request->product_id,
                'customer_id' => auth()->user()->customer->id,
                'quantity' => $request->quantity,
                'status_checkout' => false
            ]);

            $request->session()->flash('success', 'Barang Berhasil Masuk Keranjang!');
            return redirect()->route('product.all');
        } catch (\Throwable $th) {
            $request->session()->flash('error', $th->getMessage());
            return back();
        }
    }
}
