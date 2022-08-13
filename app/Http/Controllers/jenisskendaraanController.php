<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Jenisskendaraan;

class jenisskendaraanController extends Controller
{
    public function index() {

        $data = DB::table('jenisskendaraan')->get();
        return view('jeniskendaraan/index',compact('data'));
       
    }
    public function store(Request $request)
  {
    $validator = Validator::make($request->all(),[
        'merek'  => 'required',
        'jenis'  => 'required',
    ]);

    if ($validator->fails()) {
      return response()->json($validator->errors());
    }

    $data = new Jenisskendaraan();
    $data -> merek   = $request -> merek;
    $data -> jenis   = $request -> jenis;

    $data->save();
    return redirect()->back()->with('success','Data added successfully');
    
  }

  public function getAll()
  {
     

      $data= Jenisskendaraan::get();

      return response()->json(['jenisskendaraan' => $data]);
  }

  public function getById($id_jenisskendaraan)
  {
    $data = Jenisskendaraan::where('id_jenisskendaraan', '=', $id_jenisskendaraan)->first();
        
    return response()->json([
        'success' => true,
        'data' => $data
    ]);
  }

  public function update(Request $request, $id_jenisskendaraan)
  {
    $validator = Validator::make($request->all(),[
        'merek'  => 'required',
        'jenis'  => 'required',
    ]);

    if ($validator->fails()) {
      return response()->json($validator->errors());
    }

    $data = Jenisskendaraan::where('id_jenisskendaraan', '=', $id_jenisskendaraan)->first();
    $data -> merek   = $request -> merek;
    $data -> jenis   = $request -> jenis;
    
    $data->save();

    return redirect()->back()->with(['message' => 'Data jeniskendaraan berhasil diubah']);
  }

 public function destroy($id_jenisskendaraan)
    {
      $delete = Jenisskendaraan::where('id_jenisskendaraan', '=', $id_jenisskendaraan)->delete();

      return redirect()->back()->with('success', 'Data Deleted Successfully');
}
}