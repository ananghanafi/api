<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ControllerTrait;
use App\Models\RetentionBasinPlan;
use Validator;

class RetentionBasinPlanController extends Controller
{
    use ControllerTrait;
    
    
    public function document($id,Request $request) {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:doc,docx,xls,xlsx,pdf,zip',
            'description' => 'string'
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->toArray());
        }
        $impl = RetentionBasinPlan::find($id);
        $upload = $this->uploadFile($impl, 'document', $request->description);
        if(!$upload){
            return $this->sendError("Gagal Upload");
        }
        return $this->show($impl->id);
    }
    
    public function image($id,Request $request) {
        $validator = Validator::make($request->all(), [
            'file' => 'required|image',
            'collection' => "required|in:". implode(',', config('app.image-media-collection')),
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->toArray());
        }
        $impl = RetentionBasinPlan::find($id);
        $upload = $this->uploadFile($impl, $request->collection);
        if(!$upload){
            return $this->sendError("Gagal Upload");
        }
        return $this->show($impl->id);
    }

    public function index(Request $request)
    {
        $model = new RetentionBasinPlan;
        $filterable = $model->getFillable();
        $model = $model->with(['phu', 'fundingSource']);
        
        return $this->sendData($this->customPaginate($model, $request, $filterable));
    }
    
    public function store(Request $request) {
        $model = new RetentionBasinPlan;
        $validator = Validator::make($request->all(), $model->getRule());
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->toArray());
        }
        
        $exist = $model->whereCode($request->generalActivity['code'])->first();
        if($exist){
            return $this->sendError("Code ".$request->generalActivity['code']." sudah digunakan");
        }
        
        $new = $model->add($request);
        if (!$new) {
            return $this->sendError("Gagal Simpan");
        }
        return $this->show($new->id);
    }
    
    public function update($id,Request $request) {
        $model = new RetentionBasinPlan;
        $exist = $model->find($id);
        if(!$exist){
            return $this->sendError("Data tidak ada");
        }
        if(isset($request->generalActivity['code'])){
            $existCOde = $model->whereCode($request->generalActivity['code'])
                    ->whereNotIn('id',[$id])->first();
            if($existCOde){
                return $this->sendError("Code ".$request->generalActivity['code']." sudah digunakan");
            }
        }
        
        
        $request->id = $id;
        $model->ubah($request);
        return $this->show($id);
    }
    
    public function updatePatch($id,Request $request) {
        $model = new RetentionBasinPlan;
        $exist = $model->find($id);
        if(!$exist){
            return $this->sendError("Data tidak ada");
        }
        
        if(isset($request->code)){
            if($model->whereCode($request->code)->whereNotIn('id',[$id])->first()){
                return $this->sendError("Code ".$request->code." sudah digunakan");
            }
        }
        
        $model->patchUbah($request, $id);
        return $this->show($id);
    }
    
    public function updateStatus($id,Request $request) {
        $validator = Validator::make($request->all(), [
            'status' => 'required',
            'status.id' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->toArray());
        }
        $model = new RetentionBasinPlan;
        $exist = $model->find($id);
        if(!$exist){
            return $this->sendError("Data tidak ada");
        }
        
        if($exist->status != 1 && $exist->status != null){
            return $this->sendError("Plan Sudah di eksekusi");
        }
        
        if(!$exist->cost){
            return $this->sendError("Anggaran harus diisi");
        }
        
        $params = new \stdClass();
        $params->id = $id;
        $params->status = $request->status['id'];
        $n = $model->updateStatus($params);
        return $this->show($id);
    }

    public function updateAnggaran($id, Request $request) {
        $validator = Validator::make($request->all(), [
            'status' => 'required',
            'cost' => 'required',
            'fundingSource' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->toArray());
        }

        $model = new RetentionBasinPlan;
        $exist = $model->find($id);
        if(!$exist){
            return $this->sendError("Data tidak ada");
        }
        if($exist->status != 1 && $exist->status != null) {
            return $this->sendError('Rencana ini sudah disetujui');
        }
        if(!$request->cost){
            return $this->sendError("Anggaran harus diisi");
        }

        $model->patchUbah($request, $id);

        $params = new \stdClass();
        $params->id = $id;
        $params->status = $request->status;

        $model->updateStatus($params);

        return $this->show($id);
    }

    public function show($id) {
        $model = new RetentionBasinPlan;
        $model = $model->with(['phu', 'fundingSource']);
        $exist = $model->find($id);
        if(!$exist){
            return $this->sendError("Data tidak ada");
        }
        $detailActivity = null;
        
        $data = [
                'generalActivity' => $exist,
                'detailActivity' => $detailActivity,
                'status' => $exist->status()->first(),
                'files' => $exist->getFiles(),
            ];
        return $this->sendData($data);
    }
    
    public function delete($id,Request $request) {
        $model = new RetentionBasinPlan;
        $exist = $model->findNoDelete($id);
        if(!$exist){
            return $this->sendError("Data tidak ada");
        }
        $obj = new  \stdClass;
        $obj->isDeleted = 1;
        $obj->id = $id;
        $model->ubah($obj);
        return $this->sendData(['message' => 'Berhasil Hapus']);
    }
    
}
