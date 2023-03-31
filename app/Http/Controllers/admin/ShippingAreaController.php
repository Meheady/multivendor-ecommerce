<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ShipDistrict;
use App\Models\ShipDivision;
use App\Models\ShipState;
use Illuminate\Http\Request;

class ShippingAreaController extends Controller
{
    public function allDivision()
    {
        $allData = ShipDivision::all();
        return view('admin.ship.division.all-division',compact('allData'));
    }
    public function createDivision()
    {
        return view('admin.ship.division.add-division');
    }
    public function allDistrict()
    {
        $allData = ShipDistrict::all();
        return view('admin.ship.district.all-district',compact('allData'));
    }
    public function allState()
    {
        $allData = ShipState::all();
        return view('admin.ship.state.all-state',compact('allData'));
    }
}
