<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Persetujuan;

class PersetujuanController extends Controller
{
    public function store(Request $request)
    {
      $validator = Validator::make($request->all(),[
        'persetujuan'  => 'required',
      ]);
  
      if ($validator->fails()) {
        return response()->json($validator->errors());
      }
  
      $persetujuan = new Persetujuan();
      $persetujuan -> persetujuan   = $request -> persetujuan;
      
  
      $persetujuan->save();
      $persetujuan = Persetujuan::where('id_persetujuan', '=', $persetujuan->id_persetujuan)->first();
  
      return Response()->json([
        'success' => true,
        'message' => 'Data persetujuan berhasil ditambahkan',
        'data' => $persetujuan
      ]);
    }
    
}
