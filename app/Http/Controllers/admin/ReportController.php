<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use DateTime;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function reportView()
    {
        return view('admin.report.report-view');
    }
    public function reportDaily(Request $request)
    {
        $start = new DateTime($request->start);
        $end = new DateTime($request->end);

        $dateStart = $start->format('d F Y');
        $dateEnd = $end->format('d F Y');

        $allData = Order::whereBetween('order_date',[$dateStart, $dateEnd])->get();
        return view('admin.report.report-daily', compact('allData', 'dateStart', 'dateEnd'));
    }
}
