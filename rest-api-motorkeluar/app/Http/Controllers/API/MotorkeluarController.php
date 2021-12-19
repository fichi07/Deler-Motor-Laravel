<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;
use App\Models\motorkeluar;
use App\Http\Resources\Motorkeluar as MotorkeluarResource;

class MotorkeluarController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keluar = motorkeluar::all();
        return $this->sendResponse(MotorkeluarResource::collection($keluar), 'List ditampilkan.');
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
            'pemesan'=>'required',
            'id_motor'=>'required',
            'alamat'=>'required',
            'notlp' => 'required',
            'status' => 'required',
            
        ]);
        if($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        $keluar = new motorkeluar();
        $keluar->pemesan = $input['pemesan'];
        $keluar->id_motor = $input['id_motor'];
        $keluar->alamat = $input['alamat'];
        $keluar ->notlp = $input['notlp'];
        $keluar ->status = $input['status'];
        $keluar->save();
        return $this->sendResponse(new MotorkeluarResource($keluar), 'Data ditambahkan!');
    }


    public function show($id)
    {
        $keluar = motorkeluar::find($id);
        if (is_null($keluar)) {
            return $this->sendError('Data does not exist.');
        }
        return $this->sendResponse(new MotorkeluarResource($keluar), 'Data ditampilkan.');
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
        $keluar = motorkeluar::find($id);
        if (!is_null($keluar)) {
            $validator = Validator::make($input, [
                'pemesan' => 'required',
                'id_motor' => 'required',
                'alamat' => 'required',
                'notlp' => 'required',
                'status' => 'required'
            ]);

            if ($validator->fails()) {
                return $this->sendError($validator->errors());
            }

            $keluar->pemesan = $input['pemesan'];
            $keluar->id_motor = $input['id_motor'];
            $keluar->alamat = $input['alamat'];
            $keluar->notlp = $input['notlp'];
            $keluar->status = $input['status'];
            $keluar->save();
        }

        return $this->sendResponse(new MotorkeluarResource($keluar), 'Data updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Konterrhp  $handphone
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $keluar = motorkeluar::find($id);
        if (!is_null($keluar)) {
            $keluar->delete();
        }

        return $this->sendResponse([], 'Data deleted.');
    }
}
