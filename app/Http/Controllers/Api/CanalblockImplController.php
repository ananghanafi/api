<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ControllerTrait;
use App\Models\CanalblockImpl;
use App\Models\CanalBlockDetail;
use App\Models\ImplProgress;
use Validator;

class CanalblockImplController extends Controller
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
        $impl = CanalblockImpl::find($id);
        $upload = $this->uploadFile($impl, 'document', $request->description);
        if(!$upload){
            return $this->sendError("Gagal Upload");
        }
        return $this->show($impl->id);
    }
    
    public function galery($id,Request $request) {
        $validator = Validator::make($request->all(), [
            'file' => 'required|image',
            'category' => 'required|string',
            'dscription' => 'string',
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->toArray());
        }
        $impl = CanalblockImpl::find($id);
        $upload = $this->uploadFile($impl, 'galery', $request->dscription, $request->category);
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
        $impl = CanalblockImpl::find($id);
        $upload = $this->uploadFile($impl, $request->collection);
        if(!$upload){
            return $this->sendError("Gagal Upload");
        }
        return $this->show($impl->id);
    }

    public function index(Request $request)
    {
        $model = new CanalblockImpl;
        $filterable = $model->getFillable();
        $model = $model->with(['canalType','canalBlockingType','phu', 'fundingSource']);
        
        return $this->sendData($this->customPaginate($model, $request, $filterable));
    }
    
    public function store(Request $request) {
        abort(404);
    }
    
    public function update($id,Request $request) {
        $model = new CanalblockImpl;
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
        
        $modelDetail = new CanalBlockDetail;
        
        $request->id = $id;
        $ubah = $model->ubah($request,$modelDetail);
        if(!$ubah){
            return $this->sendError("Gagal Simpan");
        }
        return $this->show($id);
    }

    public function updatePatch($id,Request $request) {
        $model = new CanalblockImpl;
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
        $model = new CanalblockImpl;
        $exist = $model->find($id);
        if(!$exist){
            return $this->sendError("Data tidak ada");
        }
        
        if($exist->status != 1 && $exist->status != null){
            return $this->sendError("Status Sudah di eksekusi");
        }
        
        $params = new \stdClass();
        $params->id = $id;
        $params->status = $request->status['id'];
        $n = $model->updateStatus($params);
        return $this->show($id);
    }
    
    public function implProgress($id, Request $request) {
        $model = new ImplProgress;
        $validator = Validator::make($request->all(), $model->getRule());
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->toArray());
        }
        
        $modelDetail = new CanalBlockDetail;
        $modelDetail->addOrUbah(collect([
            'activity_id' => $id,
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
        ]), $id);
        
        $new = $model->add($request,'App\Models\CanalblockImpl');
        
        return $this->sendData(["success"]);
    }

    public function show($id) {
        $model = new CanalblockImpl;
        $model = $model->with(['canalType','canalBlockingType','phu', 'fundingSource']);
        $exist = $model->find($id);
        if(!$exist){
            return $this->sendError("Data tidak ada");
        }
        $detailActivity = $exist->canalBlockDetail()->first();
        $data = [
                'generalActivity' => $exist,
                'detailActivity' => $detailActivity,
                'status' => $exist->status()->first(),
                'files' => $exist->getFiles(),
                'implProgress' => $exist->implProgress,
            ];
        return $this->sendData($data);
    }
    
    public function delete($id,Request $request) {
        $model = new CanalblockImpl;
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
