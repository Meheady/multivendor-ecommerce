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
    public function storeDivision(Request $request)
    {
        ShipDivision::create([
           'division_name'=> $request->division_name
        ]);
        return redirect()->back()->with('success','Division save successfully');
    }
    public function editDivision($id)
    {
        $division = ShipDivision::find($id);
        return view('admin.ship.division.edit-division',compact('division'));
    }
    public function updateDivision(Request $request, $id)
    {
        ShipDivision::find($id)->update([
            'division_name'=> $request->division_name
        ]);
        return redirect()->route('all.division')->with('success','Division Update successfully');
    }
    public function deleteDivision($id)
    {
        ShipDivision::find($id)->delete();
        return redirect()->back()->with('success','Division Delete successfully');
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
