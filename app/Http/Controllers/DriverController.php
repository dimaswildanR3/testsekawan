<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Driver;

class DriverController extends Controller
{
    public function index() {

        $driverr = DB::table('driverr')->get();
        return view('Driver/index',compact('driverr'));
       
    }
    public function store(Request $request)
    {
      $validator = Validator::make($request->all(),[
        'nama'  => 'required',
      ]);
  
      if ($validator->fails()) {
        return response()->json($validator->errors());
      }
  
      $driverr = new Driver();
      $driverr ->nama= $request->nama;
      
  
      $driverr->save();
      return redirect()->back()->with('success','Data added successfully');
    }
      public function getAll()
    {
        $driverr = Driver::get();
        return response()->json([
            'success' => true,
            'data' => $driverr
        ]);
    }
    public function getById($id)
    {
        $driverr = Driver::where('id', '=', $id)->first();
        
        return response()->json([
            'success' => true,
            'data' => $driverr
        ]);
    }
    public function destroy($id)
    {
        $delete = Driver::where('id', '=', $id)->delete();

      return redirect()->back()->with('success', 'Data Deleted Successfully');
    }

}