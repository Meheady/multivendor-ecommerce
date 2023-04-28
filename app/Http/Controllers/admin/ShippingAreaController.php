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
    public function createDistrict()
    {
        $division = ShipDivision::all();
        return view('admin.ship.district.add-district',compact('division'));
    }
    public function storeDistrict(Request $request)
    {
        ShipDistrict::create([
            'division_id'=> $request->division,
            'district_name'=> $request->district_name
        ]);
        return redirect()->back()->with('success','District save successfully');
    }
    public function editDistrict($id)
    {
        $district = ShipDistrict::find($id);
        $division = ShipDivision::all();
        return view('admin.ship.district.edit-district',compact('district','division'));
    }
    public function updateDistrict(Request $request, $id)
    {
        ShipDistrict::find($id)->update([
            'division_id'=> $request->division,
            'district_name'=> $request->district_name
        ]);
        return redirect()->route('all.district')->with('success','District Update successfully');
    }
    public function deleteDistrict($id)
    {
        ShipDistrict::find($id)->delete();
        return redirect()->back()->with('success','District Delete successfully');
    }


    public function allState()
    {
        $allData = ShipState::all();
        return view('admin.ship.state.all-state',compact('allData'));
    }
    public function createState()
    {
        $division = ShipDivision::all();
        $district = ShipDistrict::all();
        return view('admin.ship.state.add-state',compact('division','district'));
    }
    public function storeState(Request $request)
    {
        ShipState::create([
            'division_id'=> $request->division,
            'district_id'=> $request->district,
            'state_name'=> $request->state_name,
        ]);
        return redirect()->back()->with('success','State save successfully');
    }
    public function editState($id)
    {
        $state = ShipState::find($id);
        $division = ShipDivision::all();
        $district = ShipDistrict::where('division_id',$state->division_id)->get();
        return view('admin.ship.state.edit-state',compact('state','division','district'));
    }
    public function updateState(Request $request, $id)
    {
        ShipState::find($id)->update([
            'division_id'=> $request->division,
            'district_id'=> $request->district,
            'state_name'=> $request->state_name,
        ]);
        return redirect()->route('all.state')->with('success','State Update successfully');
    }
    public function deleteState($id)
    {
        ShipState::find($id)->delete();
        return redirect()->back()->with('success','State Delete successfully');
    }


    public function ajaxDistrict($id)
    {
        $district = ShipDistrict::where('division_id',$id)->get();
        return json_encode($district);
    }
}
