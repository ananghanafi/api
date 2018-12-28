<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ControllerTrait;
use App\User;
use Validator;

class UserController extends Controller
{
    use ControllerTrait;
    
    
    public function index(Request $request)
    {
        $model = new User;
        if($request->s){
            $model->whereNama($request->s);
        }
        $model->where('isDeleted',0);
        return $this->sendData($model->paginate(10));
    }
    
    public function store(Request $request) {
        $model = new User;
        $validator = Validator::make($request->all(), $model->getRule());
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->toArray());
        }
        $exists = User::whereEmail($request->email)->first();
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
        $model = new User;
        $exist = $model->findNoDelete($id);
        if(!$exist){
            return $this->sendError("Data tidak ada");
        }
        $model->ubah($request,$id);
        return $this->show($id);
    }

    public function is_approve($id,Request $request) {
        $model = new User;
        $exist = $model->findNoDelete($id);
        if(!$exist){
            return $this->sendError("Data tidak ada");
        }
        if($model->is_approve != 0){
            return $this->sendError("Data tidak ada");
        }
        $model->is_approve();
        return $this->show($id);
    }
    
    public function show($id) {
        $model = new User;
        $exist = $model->findNoDelete($id);
        if(!$exist){
            return $this->sendError("Data tidak ada");
        }
        return $this->sendData($exist);
    }
    
    public function delete($id,Request $request) {
        $model = new User;
        $exist = $model->findNoDelete($id);
        if(!$exist){
            return $this->sendError("Data tidak ada");
        }
        $obj = new  \stdClass;
        $obj->isDeleted = 1;
        $obj->id = $id;
        $model->ubah($obj,$id);
        return $this->sendData(['message' => 'Berhasil Hapus']);
    }
    
}
