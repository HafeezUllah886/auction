<?php

namespace App\Http\Controllers;

use App\Models\export_cars;
use App\Models\purchase;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function index(Request $request)
    {
        $from = $request->from ?? firstDayOfMonth();
        $to = $request->to ?? date('Y-m-d');

        $purchases = purchase::whereBetween('date', [$from, $to]);
        $purchase_amount = $purchases->sum('total');
        $purchase_count = $purchases->count();

        return view('dashboard.index', compact('purchase_amount', 'purchase_count'));
    }
}
