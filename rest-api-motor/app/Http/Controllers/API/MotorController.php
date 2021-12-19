<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;
use App\Models\motor;
use App\Http\Resources\Motor as MotorResource;

class MotorController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $moto = motor::all();
        return $this->sendResponse(MotorResource::collection($moto), 'List Motor ditampilkan.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'nama'=>'required',
            'warna'=>'required',
            'tahun' => 'required',
            'stok' => 'required',
            'harga' => 'required'
        ]);
        if($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        $moto = new motor();
        $moto->nama = $input['nama'];
        $moto->warna = $input['warna'];
        $moto ->tahun = $input['tahun'];
        $moto ->stok = $input['stok'];
        $moto ->harga = $input['harga'];
        $moto->save();
        return $this->sendResponse(new MotorResource($moto), 'Data ditambahkan!');
    }


    public function show($id)
    {
        $moto = motor::find($id);
        if (is_null($moto)) {
            return $this->sendError('Data does not exist.');
        }
        return $this->sendResponse(new MotorResource($moto), 'Data ditampilkan.');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Konterrhp $handphone
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $input = $request->all();

        $moto = motor::find($id);
        if (!is_null($moto)) {
            $validator = Validator::make($input, [
                'nama' => 'required',
                'warna' => 'required',
                'tahun' => 'required',
                'stok' => 'required',
                'harga' => 'required'
            ]);

            if ($validator->fails()) {
                return $this->sendError($validator->errors());
            }

            $moto->nama = $input['nama'];
            $moto->warna = $input['warna'];
            $moto->tahun = $input['tahun'];
            $moto->stok = $input['stok'];
            $moto->harga = $input['harga'];
            $moto->save();
        }

        return $this->sendResponse(new MotorResource($moto), 'Data updated.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Konterrhp  $handphone
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $moto = motor::find($id);
        if (!is_null($moto)) {
            $moto->delete();
        }

        return $this->sendResponse([], 'Data deleted.');

    }
}
