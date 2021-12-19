<?php

namespace App\Http\Controllers;

use App\Models\motorkeluar;
use Illuminate\Http\Request;

class MotorkeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return motorkeluar::all();
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $keluar = new motorkeluar();
        $keluar->pemesan = $request->pemesan;
        $keluar->id_motor = $request->id_motor;
        $keluar->alamat = $request->alamat;
        $keluar->notlp = $request->notlp;
        $keluar->status= $request->status;
        $keluar->save();
        
        return "Data Telah Disimpan";//
    }

 
    public function update(Request $request, $id)
    {
        $pemesan = $request->pemesan;
        $id_motor=$request->id_motor;
        $alamat = $request->alamat;
        $notlp = $request->notlp;
        $status = $request->status;

        $keluar= motorkeluar::find($id);
        $keluar->pemesan=$pemesan;
        $keluar->id_motor=$id_motor;
        $keluar->alamat=$alamat;
        $keluar->notlp= $notlp;
        $keluar->status= $status;
        $keluar->save();

        return "Data Berhasil Diubah"; // //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\motorkeluar  $motorkeluar
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $keluar = motorkeluar::find($id);
        $keluar ->delete();
        
        return "Data Berhasil Dihapus";////
    }
}
