<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Karyawan;
use App\Models\Payment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCust = Customer::count();
        $totalKar = Karyawan::count();
        $totalPay = Payment::count();
        return view('admin.dashboard.index', compact('totalCust', 'totalKar', 'totalPay'));
    }
}
