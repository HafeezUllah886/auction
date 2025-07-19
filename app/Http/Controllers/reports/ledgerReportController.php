<?php

namespace App\Http\Controllers\reports;

use App\Http\Controllers\Controller;
use App\Models\accounts;
use App\Models\transactions;
use Illuminate\Http\Request;

class ledgerReportController extends Controller
{
    public function index()
    {
        return view('reports.ledger_report.index');
    }   

    public function reportData(Request $request)
    {
        $id = $request->accountID;
        $from = $request->from;
        $to = $request->to;

        $account = accounts::find($id);

        $transactions = transactions::where('account_id', $id)->whereBetween('date', [$from, $to])->get();

        $pre_cr = transactions::where('account_id', $id)->whereDate('date', '<', $from)->sum('cr');
        $pre_db = transactions::where('account_id', $id)->whereDate('date', '<', $from)->sum('db');
        $pre_balance = $pre_cr - $pre_db;

        $cur_cr = transactions::where('account_id', $id)->sum('cr');
        $cur_db = transactions::where('account_id', $id)->sum('db');

        $cur_balance = $cur_cr - $cur_db;

        return view('reports.ledger_report.details', compact('account', 'transactions', 'pre_balance', 'cur_balance', 'from', 'to'));
    }
}
