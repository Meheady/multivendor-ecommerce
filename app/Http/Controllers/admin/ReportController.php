<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
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
    public function reportMonthly(Request $request)
    {
        $allData = Order::where('order_month',$request->month)->where('order_year',$request->year)->get();
        $month = $request->month;
        $year = $request->year;
        return view('admin.report.report-monthly', compact('allData','month','year' ));
    }
    public function reportYearly(Request $request)
    {
        $year = $request->year;
        $allData = Order::where('order_year',$request->year)->get();
        return view('admin.report.report-yearly', compact('allData','year' ));
    }
    public function getReportByUser()
    {
        $user = User::where('role','user')->get();
        return view('admin.report.report-by-user',compact('user'));
    }
    public function reportByUser(Request $request)
    {
        $allData = Order::where('user_id',$request->user)->get();
        $user = User::where('role','user')->get();
        return view('admin.report.report-by-user',compact('allData','user'));
    }
}
