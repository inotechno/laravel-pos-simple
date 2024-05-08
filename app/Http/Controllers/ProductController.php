<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('product.index', compact('products'));
    }

    public function all()
    {
        $products = Product::all();
        return view('product.order', compact('products'));
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
        $request->validate([
            'name' => 'required',
            'price' => 'required|integer',
            'description' => 'min:10',
            'stock' => 'required|integer',
        ]);

        try {
            if ($request->hasFile('image')) {
                $uuid = Str::uuid();

                $extension = $request->image->getClientOriginalExtension();
                $filenameSimpan = $uuid . '_' . time() . '.' . $extension;
                $path = $request->image->storeAs('product_images', $filenameSimpan, 'public');
            } else {
                $path = null;
            }

            $product = Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'stock' => $request->stock,
                'image' => $path
            ]);

            $request->session()->flash('success', 'Data Produk Berhasil Ditambahkan!');
            return redirect()->route('product.index');
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
    public function show($id)
    {
        //
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
        $request->validate([
            'name' => 'required',
            'price' => 'required|integer',
            'description' => 'min:10',
            'stock' => 'required|integer',
        ]);

        try {
            $product = Product::find($id);

            if ($request->hasFile('image')) {
                $uuid = Str::uuid();

                $extension = $request->file('image')->getClientOriginalExtension();
                $filenameSimpan = $uuid . '_' . time() . '.' . $extension;
                $path = $request->image->storeAs('product_images', $filenameSimpan, 'public');

                // Menghapus file jika ada
                if ($product->image) {
                    Storage::disk('public')->delete($product->image);
                }
            } else {
                $path = $product->image;
            }

            // dd($path);

            $product->update([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'stock' => $request->stock,
                'image' => $path
            ]);

            $request->session()->flash('success', 'Data Produk Berhasil Diubah!');
            return redirect()->route('product.index');
        } catch (\Throwable $th) {
            $request->session()->flash('error', $th->getMessage());
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $product = Product::find($id);

            // Menghapus file jika ada
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $product->delete();
            request()->session()->flash('success', 'Data Produk Berhasil Dihapus!');
            return redirect()->route('product.index');
        } catch (\Throwable $th) {
            request()->session()->flash('error', $th->getMessage());
            return back();
        }
    }
}
