<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ControllerTrait;
use App\Models\Personal;
use DB;
use Validator;

class PersonalController extends Controller
{
    use ControllerTrait;
    
    
    public function index(Request $request)
    {
        $model = new Personal;
        if($request->s){
            $model->whereNama($request->s);
        }
        // $model = $model->with(['admin','jenis']);
        // $model->tampil();
        // return $this->show($model->paginate(10));
       $model->where('isDeleted',0);
        return $this->sendData($model->paginate(10));
    }
    
    
    public function store(Request $request) {
        $model = new Personal;
        $validator = Validator::make($request->all(), $model->getRule());
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->toArray());
        }
        $exists = Personal::whereEmail($request->email)->first();
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
        $model = new Personal;
        $exist = $model->find($id);
        // $exist = $model->findNoDelete($id);
        if(!$exist){
            return $this->sendError("Data tidak ada");
        }
        $model->ubah($request,$id);
        return $this->show($id);
    }

    public function is_approve($id,Request $request) {
        $model = new Personal;
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
        $model = new Personal;
        $exist = $model->find($id);
        if(!$exist){
            return $this->sendError("Data tidak ada");
        }
        return $this->sendData($exist);
    }
    
    public function delete($id,Request $request) {
        $model = new Personal;
        $exist = $model->findNoDelete($id);
        if(!$exist){
            return $this->sendError("Data tidak ada");
        }
        $obj = new  \stdClass;
        // $obj->isDeleted = 1;
        $obj->id = $id;
        $model->ubah($obj,$id);
        return $this->sendData(['message' => 'Berhasil Hapus']);
    }
    public function tampil(Request $request){
        $model = new Personal;
        if($request->s){
            $model->whereNama($request->s);
        }
        $model->tampil();

        $dd = $this->sendData($model->paginate(15));
        
        return  $dd;
        // return $this->sendData($model->paginate(15));
    }
    public function listuser(){
        $ss= $this->getFillable();
        $setData= Personal::select('name','admin','jenis','jmlanggota','email',DB::raw('COUNT(email) as panjang'))->get();
        $setDataCount = DB::table('personals')->count();

        // $targetedAdmin = DB::table('admin')->get();
        // $targetedJenis = DB::table('jenis')->get();
 
       // $collection = collect([$totalFunding])->collapse();

       $collection = collect([$setData])->collapse();
    //    foreach($collection as $collection){
    //        $ss=[$collection->name];
    //    }
        // $item = $setDataCount;
        // $setDataCount = $collection->map(function ($item) {
        //     return $item->panjang;
        // });

        // $total = [];
        // foreach(){
            $setData5 = DB::table('personals')
            ->select('email')->get();

        // }
        $resp = [];
        for($i=1; $i<($setDataCount+1) ;$i++){
            $targetedAdmin = DB::table('admin')->select('admin_id')->get();
            $targetedJenis = DB::table('jenis')->select('jenis_id')->get();
            $setData1 = DB::table('personals')
            ->select('name')->get();
            $setData2 = DB::table('personals')
            ->select('admin')->get();
            $setData3 = DB::table('personals')
            ->select('jenis')->get();
            $setData4 = DB::table('personals')
            ->select('jmlanggota')->get();
            $setData5 = DB::table('personals')
            ->select('email')->get();

            ${'coll'.$i}=collect($targetedAdmin)->max();
            ${'col'.$i}=collect($setData1)->max();
            $resp[]= [${'coll'.$i}, ${'col'.$i}] ;
            }
        


        //  return json_encode($resp);
        return json_encode($ss);
    }
}
