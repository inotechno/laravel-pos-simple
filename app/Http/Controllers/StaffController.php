<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('staff')->whereHas('roles', function ($query) {
            $query->where('name', 'staff');
        })->get();

        // dd($users);
        return view('staff.index', compact('users'));
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
            'email' => 'required|email',
            'phone_number' => 'nullable',
        ]);

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt('password'),
                'status' => true
            ]);

            $user->assignRole('staff');

            Staff::create([
                'user_id' => $user->id,
                'phone_number' => $request->phone_number
            ]);

            $request->session()->flash('success', 'Data staff berhasil di tambahkan!');
            return redirect()->route('staff.index');
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
        // dd($request);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'nullable',
        ]);

        try {

            $user = User::find($id);

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt('password'),
                'status' => true
            ]);

            $user->staff()->update([
                'user_id' => $user->id,
                'phone_number' => $request->phone_number
            ]);

            $request->session()->flash('success', 'Data Staff Berhasil Diubah!');
            return redirect()->route('staff.index');
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
            $user = User::find($id);
            $user->delete();

            request()->session()->flash('success', 'Data Staff Berhasil Dihapus!');
            return redirect()->route('staff.index');
        } catch (\Throwable $th) {
            request()->session()->flash('error', $th->getMessage());
            return back();
        }
    }
}
