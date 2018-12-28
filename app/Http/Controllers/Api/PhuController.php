<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ControllerTrait;
use App\Models\PeatHydrologicalUnity;
use Validator;

class PhuController extends Controller
{
    use ControllerTrait;
    
    public function all(Request $request)
    {
        $model = new PeatHydrologicalUnity;
        $filterable = $model->getFillable();
        $model = $model->with('area.admArea');
        if($request->adm_area_id){
            $adm_area_id = $request->adm_area_id;
            $model = $model->whereHas('area.province', function ($query) use ($adm_area_id) {
                $query->where([
                    'province_id' => $adm_area_id
                ]);
            })->orWhereHas('area.city', function ($query) use ($adm_area_id) {
                $query->where([
                    'city_id' => $adm_area_id
                ]);
            });
        }
        
        return $this->sendData($this->customGet($model,$filterable));
    }
    
    public function index(Request $request)
    {
        $model = new PeatHydrologicalUnity;
        if($request->s){
            $model->where('full_name',$request->s);
        }
        return $this->sendData($model->paginate());
    }
    
    public function store(Request $request) {
        $model = new PeatHydrologicalUnity;
        $validator = Validator::make($request->all(), $model->getRule());
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->toArray());
        }
        $exists = PeatHydrologicalUnity::whereCode($request->code)->first();
        if($exists){
            return $this->sendError("Code $request->code sudah pernah digunakan");
        }
        $new = $model->add($request);
        if (!$new) {
            return $this->sendError("Gagal Simpan");
        }
        return $this->show($new->id);
    }
    
    public function update($id,Request $request) {
        $model = new PeatHydrologicalUnity;
        $exist = $model->find($id);
        if(!$exist){
            return $this->sendError("Data tidak ada");
        }
        $model->ubah($request,$id);
        return $this->show($id);
    }

    public function show($id) {
        $model = new PeatHydrologicalUnity;
        $exist = $model->find($id);
        if(!$exist){
            return $this->sendError("Data tidak ada");
        }
        return $this->sendData($exist);
    }
    
    public function delete($id,Request $request) {
        $model = new PeatHydrologicalUnity;
        $exist = $model->find($id);
        if(!$exist){
            return $this->sendError("Data tidak ada");
        }
        $exist->delete();
        return $this->sendData(['message' => 'Berhasil Hapus']);
    }
    
}
