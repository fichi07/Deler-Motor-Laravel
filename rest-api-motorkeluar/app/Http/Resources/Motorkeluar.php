<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Motorkeluar extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'pemesan' => $this->pemesan,
            'id_motor' => $this->id_motor,
            'alamat' => $this->alamat,
            'notlp' =>$this->notlp,
            'status'=>$this->status,
            'created_at'=>$this->created_at
        ];
    }
}
