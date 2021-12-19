<?php

namespace App\Http\Controllers;

use App\Models\motor;
use Illuminate\Http\Request;

class MotorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return motor::all(); //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      $motor = new motor();
      $motor->nama = $request->nama;
      $motor->warna = $request->warna;
      $motor->tahun = $request->tahun;
      $motor->stok= $request->stok;
      $motor->harga= $request->harga;
      $motor->save();
      
      return "Data Telah Disimpan";//
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
  
    public function update(Request $request, $id)
    {
        $nama = $request->nama;
        $warma = $request->warna;
        $tahun = $request->tahun;
        $stok = $request->stok;
        $harga = $request->harga;

        $moto= motor::find($id);
        $moto->nama=$nama;
        $moto->warna=$warma;
        $moto->tahun = $tahun;
        $moto->stok= $stok;
        $moto ->harga=$harga;
        $moto->save();

        return "Data Berhasil Diubah"; //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\motor  $motor
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $moto = motor::find($id);
        $moto ->delete();
        
        return "Data Berhasil Dihapus";//
    }
}
