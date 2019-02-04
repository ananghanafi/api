<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ControllerTrait;
use App\Models\Organisasi;
use Validator;

class OrganisasiController extends Controller
{
    use ControllerTrait;
    
    
    public function index(Request $request)
    {
        $model = new Organisasi;
        $filterable = $model->getFillable();
        return $this->sendData($this->paginasi($model, $request, $filterable));
    }
    
    public function store(Request $request) {
        $model = new Organisasi;
        $validator = Validator::make($request->all(), $model->getRule());
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->toArray());
        }

        $new = $model->add($request);
        if (!$new) {
            return $this->sendError("Gagal Simpan");
        }
        return $this->show($new->id);
    }
    
    public function update($id,Request $request) {
        $model = new Organisasi;
        $exist = $model->find($id);
        if(!$exist){
            return $this->sendError("Data tidak ada");
        }
        $model->ubah($request,$id);
        return $this->show($id);
    }

    public function show($id) {
        $model = new Organisasi;
        $exist = $model->find($id);
        if(!$exist){
            return $this->sendError("Data tidak ada");
        }
        return $this->sendData($exist);
    }
    
    public function delete($id,Request $request) {
        $model = new Organisasi;
        $exist = $model->find($id);
        if(!$exist){
            return $this->sendError("Data tidak ada");
        }
        $exist->delete();
        return $this->sendData(['message' => 'Berhasil Hapus']);
    }
    
}
