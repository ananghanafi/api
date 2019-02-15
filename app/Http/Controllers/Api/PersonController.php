<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ControllerTrait;
use App\Models\Person;
use Validator;

class PersonController extends Controller
{
    use ControllerTrait;
    
    
    public function index(Request $request)
    {
        $model = new Person;
        if($request->s){
            $model->where('fullName',$request->s);
        }
        return $this->sendData($model->paginasi());
    }
    
    public function store(Request $request) {
        $model = new Person;
        $validator = Validator::make($request->all(), $model->getRule());
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->toArray());
        }
        $exists = Person::whereEmail($request->email)->first();
        if($exists){
            return $this->sendError("Email $request->email sudah pernah digunakan");
        }
        $new = $model->add($request);
        if (!$new) {
            return $this->sendError("Gagal Simpan");
        }
        return $this->show($new->id);
    }
    
    public function update($id,Request $request) {
        $model = new Person;
        $exist = $model->findNoDelete($id);
        if(!$exist){
            return $this->sendError("Data tidak ada");
        }
        $model->ubah($request,$id);
        return $this->show($id);
    }

    public function show($id) {
        $model = new Person;
        $exist = $model->find($id);
        if(!$exist){
            return $this->sendError("Data tidak ada");
        }
        return $this->sendData($exist);
    }
    
    public function delete($id,Request $request) {
        $model = new Person;
        $exist = $model->findNoDelete($id);
        if(!$exist){
            return $this->sendError("Data tidak ada");
        }
        $data = collect(['isDeleted' => 1]);
        $model->ubah($data,$id);
        return $this->sendData(['message' => 'Berhasil Hapus']);
    }
  
    
}
