<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Staff;
use App\Models\Customer;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $staffs = Staff::all();
        $customers = Customer::all();

        $query = Bill::query()->with(['staff', 'customer']);

        // Filter berdasarkan staff_id jika ada dalam request
        $query->when($request->has('staff_id'), function ($q) use ($request) {
            return $q->where('staff_id', $request->staff_id);
        });

        // Filter berdasarkan customer_id jika ada dalam request
        $query->when($request->has('customer_id'), function ($q) use ($request) {
            return $q->where('customer_id', $request->customer_id);
        });

        // Ambil data tagihan sesuai dengan filter yang diterapkan
        $bills = $query->get();

        return view('bill.report', compact('bills', 'staffs', 'customers'));
    }
}
