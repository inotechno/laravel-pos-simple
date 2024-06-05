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

        $bills = Bill::with('staff', 'customer')
            ->when($request->customer_id, function ($builder) use ($request) {
                $builder->where('customer_id', $request->customer_id);
            })
            ->when($request->staff, function ($builder) use ($request) {
                $builder->where('staff', $request->staff);
            })->get();

        return view('bill.report', compact('bills', 'staffs', 'customers'));
    }
}
