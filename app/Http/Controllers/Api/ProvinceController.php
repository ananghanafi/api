<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ControllerTrait;
use App\Models\Province;
use Validator;

class ProvinceController extends Controller
{
    use ControllerTrait;
    
    public function all()
    {
        $model = new Province;
        return $this->sendData($model->get());
    }

    public function enabled()
    {
        $model = new Province;
        return $this->sendData($model->where('is_enabled', 1)->get());
    }
    
    public function index(Request $request)
    {
        $model = new Province;
        $filterable = $model->getFillable();
        $this->filter->setFilterables($filterable);
        
        $result = $model->filter($this->filter);
        return $this->sendData($result->paginate());
    }
    
    public function store(Request $request) {
        $model = new Province;
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
        $model = new Province;
        $exist = $model->find($id);
        if(!$exist){
            return $this->sendError("Data tidak ada");
        }
        $model->ubah($request,$id);
        return $this->show($id);
    }

    public function show($id) {
        $model = new Province;
        $exist = $model->find($id);
        if(!$exist){
            return $this->sendError("Data tidak ada");
        }
        return $this->sendData($exist);
    }
    
    public function delete($id,Request $request) {
        $model = new Province;
        $exist = $model->find($id);
        if(!$exist){
            return $this->sendError("Data tidak ada");
        }
        $exist->delete();
        return $this->sendData(['message' => 'Berhasil Hapus']);
    }
    
}
