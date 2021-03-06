<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ControllerTrait;
use App\Models\DonorDash;
use App\Models\MBrgMandat;
use App\Models\PeatHydrologicalUnity;
use App\Models\ConstructionPlan;
use App\Models\DonorActivity;
 use Validator;
use DB;

class DonorDashController extends Controller
{
    use ControllerTrait;
    public function index(Request $request)
    {
        $model = new DonorDash;
        $filterable = $model->getFillable();
        $model = $model->with(['fundingSource','implementingAgency','currency','status','brgMandat','phu']);
        return $this->sendData($this->paginasi($model, $request, $filterable));
    }
    
    public function store(Request $request) {
        $model = new DonorDash;
       $validator = Validator::make($request->all(), $model->getRule());
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->toArray());
        }
        $fundingSource = $request->fundingSource;
        $administrativeArea = $request->administrativeArea;
        $province = $administrativeArea['province'];
        $city = $administrativeArea['city'];
        $subDistrict = $administrativeArea['subDistrict'];
        $currency = $request->currency;
        $implementingAgency = $request->implementingAgency;
        
        $params = array_merge($request->all(),[
            'funding_source' => $fundingSource['id'],
            'province_id' => $province['provinceId'],
            'city_id' => $city['cityId'],
            'sub_district_id' => $subDistrict['id'],
            'currency' => $currency['id'],
            'implementing_agency' => $implementingAgency['id'],
            'village' => $administrativeArea['village'],
        ]);
        unset($params['status']);
        DB::beginTransaction();
        $new = $model->add(collect($params));
        $phuIds=[];
        $brgMandatIds =[];
        foreach ($request->phu as $phu) {
           $phuIds[] = $phu['id'];
        }
        $new->phu()->sync($phuIds);
        foreach ($request->brgMandat as $brgMandat) {
            $brgMandatIds[] = $brgMandat['id'];
        }
        $new->brgMandat()->sync($brgMandatIds);
        
        DB::commit();
        return $this->show($new->id);
    }

    public function storeorg(){
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
        $model = new DonorDash;
        $exist = $model->find($id);
        if(!$exist){
            return $this->sendError("Data tidak ada");
        }
        
      
        $fundingSource = $request->fundingSource;
        $administrativeArea = $request->administrativeArea;
        $province = $administrativeArea['province'];
        $city = $administrativeArea['city'];
        $subDistrict = $administrativeArea['subDistrict'];
        $currency = $request->currency;
        $implementingAgency = $request->implementingAgency;
        
        $params = array_merge($request->all(),[
            'funding_source' => $fundingSource['id'],
            'province_id' => $province['provinceId'],
            'city_id' => $city['cityId'],
            'sub_district_id' => $subDistrict['id'],
            'currency' => $currency['id'],
            'implementing_agency' => $implementingAgency['id'],
            'village' => $administrativeArea['village'],
        ]);
        
        unset($params['status']);
        DB::beginTransaction();
        $model->ubah(collect($params),$id);
        $phuIds=[];
        $brgMandatIds =[];
        foreach ($request->phu as $phu) {
           $phuIds[] = $phu['id'];
        }
        $exist->phu()->sync($phuIds);
        foreach ($request->brgMandat as $brgMandat) {
            $brgMandatIds[] = $brgMandat['id'];
        }
        $exist->brgMandat()->sync($brgMandatIds);
        
        DB::commit();
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
        $model = new DonorDash;
        $exist = $model->find($id);
        if(!$exist){
            return $this->sendError("Data tidak ada");
        }
        
        
        $params = new \stdClass();
        $params->id = $id;
        $params->status = $request->status['id'];
        $n = $model->updateStatus($params);
        return $this->show($id);
    }
    
    public function show($id) {
        $model = new DonorDash;
        $exist = $model->with(['fundingSource','implementingAgency','currency','status','brgMandat','phu'])->find($id);
        if(!$exist){
            return $this->sendError("Data tidak ada");
        }
        return $this->sendData($exist);
    }
    
    public function delete($id,Request $request) {
        $model = new DonorDash;
        $exist = $model->findNoDelete($id);
        if(!$exist){
            return $this->sendError("Data tidak ada");
        }
        $data = collect(['isDeleted' => 1]);
        $model->ubah($data,$id);
        return $this->sendData(['message' => 'Berhasil Hapus']);
    }
    public function org(){
        $model = new DonorDash;

    }
    public function coba(){
        $data='[
            {
                "id" : 1,
                "title":"Judul",
                "summary" : "Kegiatan",
                "start_date":"2018-11-18 16:17:41",
                "end_date":"2019-11-18 16:17:41",
                "amount":5000,
                "currency":5000,
                "funding_source": 5000,
                "implementing_agency": 20,
                "remark": "Remark",
                "year":"2018",
                "province_id" : 14 ,
                "city_id" : 1402,
                "sub_district_id" : 1401001,
                "village" : 140100111,
                "x" : 107.44,
                "y" : 107.44,
                "status" : 0,

        },
        {
            "title":"Judul",
            "amount":5000,
            "currency": {
                "id":1
            },
             "phu_id": {
                "id":1
            },
            "fundingSource":{
                "id":1
            },
            "implementingAgency":{
                "id":1
            },
            "administrativeArea":{
                "province": {
                    "provinceId":1
                },
                "city":{
                    "cityId":1
                },
                "subDistrict":{
                    "id":1
                },
                "village":{
                    "villageId":1
                }
            } 
           
        }
        ]';
        return $data;
    }
    public function anggaran()
    {
// $peatlandRewetting =  DonorDash::select('donor_activities.id','donor_activities.amount','province_id',DB::raw('SUM(amount) as anggaran'),'donor_activities.currency' )
//                         ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
//                         ->where('mandat_id', 1)
//                         ->groupBy('province_id')->get()->toArray();
// $revegetation =  DonorDash::select('donor_activities.id','donor_activities.amount','donor_activities.province_id',DB::raw('SUM(amount) as anggaran'),'donor_activities.currency')
//                         ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
//                         ->where('mandat_id', 2)
//                         ->groupBy('province_id')->get()->toArray();
// $revitalization =  DonorDash::select('donor_activities.id','donor_activities.amount','donor_activities.province_id',DB::raw('SUM(amount) as anggaran'),'donor_activities.currency')
//                         ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
//                         ->where('mandat_id', 3)
//                         ->groupBy('province_id')->get()->toArray();
// $baseStabilization =  DonorDash::select('donor_activities.id','donor_activities.amount','donor_activities.province_id',DB::raw('SUM(amount) as anggaran'),'donor_activities.currency')
//                         ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
//                         ->where('mandat_id', 4)
//                         ->groupBy('province_id')->get()->toArray();
// $instStrengthening =  DonorDash::select('donor_activities.id','donor_activities.amount','donor_activities.province_id',DB::raw('SUM(amount) as anggaran'),'donor_activities.currency')
                        // ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
                        // ->where('mandat_id', 5)
                        // ->groupBy('province_id')->get()->toArray();
// $coopImprove =  DonorDash::select('donor_activities.id','donor_activities.amount','donor_activities.province_id',DB::raw('SUM(amount) as anggaran'),'donor_activities.currency')
//                         ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
//                         ->where('mandat_id', 6)
//                         ->groupBy('province_id')->get()->toArray();
// $actifRoles =  DonorDash::select('donor_activities.id','donor_activities.amount','donor_activities.province_id',DB::raw('SUM(amount) as anggaran'),'donor_activities.currency')
//                         ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
//                         ->where('mandat_id', 7)
//                         ->groupBy('province_id')->get()->toArray();
// $peatlandRestoration =  DonorDash::select('donor_activities.id','donor_activities.amount','donor_activities.province_id',DB::raw('SUM(amount) as anggaran'),'donor_activities.currency')
//                         ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
//                         ->where('mandat_id', 8)
//                         ->groupBy('province_id')->get()->toArray();
// $adminstrartionManagement =  DonorDash::select('donor_activities.id','donor_activities.amount','donor_activities.province_id',DB::raw('SUM(amount) as anggaran'),'donor_activities.currency')
//                         ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
//                         ->where('mandat_id', 9)
//                         ->groupBy('province_id')->get()->toArray();
// $dbBrgMandat = DB::table('m_brg_mandat')->select('m_brg_mandat.id','desc_en')->get();
//        $collection = collect([$peatlandRewetting, $revegetation, $revitalization, $baseStabilization, $instStrengthening, $coopImprove, $actifRoles, $peatlandRestoration, $adminstrartionManagement ]);
//         $allCost = $collection->collapse();
//         $prov = [];
      //  $cek="";
    //     $total_anggaran = 0;
    //     foreach ($allCost->all() as $ang){
    //         $province_id = $ang['administrative_area']['province']->province_id;
    //         $prov[$province_id] = [
    //             'anggaran' => (isset($prov[$province_id]['anggaran']) ? $prov[$province_id]['anggaran'] : 0) + $ang['amount'],
    //             'province' => $ang['administrative_area']['province'],
    //         ];
    //         $total_anggaran += isset($prov[$province_id]['anggaran']) ? $prov[$province_id]['anggaran'] : 0;
    //    }
        
      $peatlandRewetting = DB::table('donor_activities')->sum('amount');
        // $resp = [];
        // foreach ($prov as $p) {
        //     $resp[] = [
        //         'anggaran' => $p['anggaran'],
        //         'persen' => $total_anggaran ? 100 * ($p['anggaran']/$total_anggaran ) : 0,
        //         'province' => $p['province']->long_name,
        //     ];
        // }
        $fdsf=66;
           $resp = ['anggaran'=>$peatlandRewetting, 'anggaran'=>$fdsf];
//         $resp = [];
//         foreach ($allCost->all() as $p) {
//             $resp[] = [
//                 'anggaran' => $p['anggaran'],
//                 'persen' => $total_anggaran ? 100 * ($p['anggaran']/$total_anggaran ) : 0,
//                  'province' => $p['province']->long_name,
//             ];
//         }
   return $this->sendData($resp);
//        return $this->sendData($resp);
    }
    // $ptrwt='';
    // $rvg ="";
    // $rev="";

    public function peatlandrewetting(){
        // $peatlandRewetting =  DB::table('donor_activities')->select('donor_activities.id','donor_activities.amount','province_id',DB::raw('SUM(amount) as anggaran'),'donor_activities.currency' )
        // ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
        // ->where('mandat_id', 1)
        // ->groupBy('province_id')->first();
        $peatlandRewetting =  DB::table('donor_activities')->select('donor_activities.id','donor_activities.amount','province_id',DB::raw('SUM(amount) as anggaran'))
        ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
        ->where(function ($query){
            $query->where('donor_activities.currency','=' ,'1')
            ->where('mandat_id','=' ,'1');
        })
        ->groupBy('province_id')->first();
        $collection=collect($peatlandRewetting)->max();
        $respi = ['anggaran'=>$collection];
        return $this->sendData($respi);

    }
    public function revegetation(){
        // $peatlandRewetting =  DB::table('donor_activities')->select('donor_activities.id','donor_activities.amount','province_id',DB::raw('SUM(amount) as anggaran'),'donor_activities.currency' )
        // ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
        // ->where('mandat_id', 2)
        // ->groupBy('province_id')->first();
        $peatlandRewetting =  DB::table('donor_activities')->select('donor_activities.id','donor_activities.amount','province_id',DB::raw('SUM(amount) as anggaran'))
        ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
        ->where(function ($query){
            $query->where('donor_activities.currency','=' ,'1')
            ->where('mandat_id','=' ,'2');
        })
        ->groupBy('province_id')->first();
        $collection=collect($peatlandRewetting)->max();
        $respi = ['anggaran'=>$collection];
        return $this->sendData($respi);
    }
    public function revitalization(){
        // $peatlandRewetting =  DB::table('donor_activities')->select('donor_activities.id','donor_activities.amount','province_id',DB::raw('SUM(amount) as anggaran'),'donor_activities.currency' )
        // ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
        // ->where('mandat_id', 3)
        // ->groupBy('province_id')->first();
        $peatlandRewetting =  DB::table('donor_activities')->select('donor_activities.id','donor_activities.amount','province_id',DB::raw('SUM(amount) as anggaran'))
        ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
        ->where(function ($query){
            $query->where('donor_activities.currency','=' ,'1')
            ->where('mandat_id','=' ,'3');
        })
        ->groupBy('province_id')->first();
        $collection=collect($peatlandRewetting)->max();
        $respi = ['anggaran'=>$collection];
        return $this->sendData($respi);
    }
    public function baseStabilization(){
        // $peatlandRewetting =  DB::table('donor_activities')->select('donor_activities.id','donor_activities.amount','province_id',DB::raw('SUM(amount) as anggaran'),'donor_activities.currency' )
        // ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
        // ->where('mandat_id', 4)
        // ->groupBy('province_id')->first();
        $peatlandRewetting =  DB::table('donor_activities')->select('donor_activities.id','donor_activities.amount','province_id',DB::raw('SUM(amount) as anggaran'))
        ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
        ->where(function ($query){
            $query->where('donor_activities.currency','=' ,'1')
            ->where('mandat_id','=' ,'4');
        })
        ->groupBy('province_id')->first();
        $collection=collect($peatlandRewetting)->max();
        $respi = ['anggaran'=>$collection];
        return $this->sendData($respi);
    }
    public function instStrengthening(){
        // $peatlandRewetting =  DB::table('donor_activities')->select('donor_activities.id','donor_activities.amount','province_id',DB::raw('SUM(amount) as anggaran'),'donor_activities.currency' )
        // ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
        // ->where('mandat_id', 5)
        // ->groupBy('province_id')->first();
        $peatlandRewetting =  DB::table('donor_activities')->select('donor_activities.id','donor_activities.amount','province_id',DB::raw('SUM(amount) as anggaran'))
        ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
        ->where(function ($query){
            $query->where('donor_activities.currency','=' ,'1')
            ->where('mandat_id','=' ,'5');
        })
        ->groupBy('province_id')->first();
        $collection=collect($peatlandRewetting)->max();
        $respi = ['anggaran'=>$collection];
        return $this->sendData($respi);
    }
    public function coopImprove(){
        // $peatlandRewetting =  DB::table('donor_activities')->select('donor_activities.id','donor_activities.amount','province_id',DB::raw('SUM(amount) as anggaran'),'donor_activities.currency' )
        // ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
        // ->where('mandat_id', 6)
        // ->groupBy('province_id')->first();
        $peatlandRewetting =  DB::table('donor_activities')->select('donor_activities.id','donor_activities.amount','province_id',DB::raw('SUM(amount) as anggaran'))
        ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
        ->where(function ($query){
            $query->where('donor_activities.currency','=' ,'1')
            ->where('mandat_id','=' ,'6');
        })
        ->groupBy('province_id')->first();
        $collection=collect($peatlandRewetting)->max();
        $respi = ['anggaran'=>$collection];
        return $this->sendData($respi);
    }
    public function actifRoles(){
        // $peatlandRewetting =  DB::table('donor_activities')->select('donor_activities.id','donor_activities.amount','province_id',DB::raw('SUM(amount) as anggaran'),'donor_activities.currency' )
        // ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
        // ->where('mandat_id', 7)
        // ->groupBy('province_id')->first();
        $peatlandRewetting =  DB::table('donor_activities')->select('donor_activities.id','donor_activities.amount','province_id',DB::raw('SUM(amount) as anggaran'))
        ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
        ->where(function ($query){
            $query->where('donor_activities.currency','=' ,'1')
            ->where('mandat_id','=' ,'7');
        })
        ->groupBy('province_id')->first();
        $collection=collect($peatlandRewetting)->max();
        $respi = ['anggaran'=>$collection];
        return $this->sendData($respi);
    }
    public function peatlandRestoration(){
        // $peatlandRewetting =  DB::table('donor_activities')->select('donor_activities.id','donor_activities.amount','province_id',DB::raw('SUM(amount) as anggaran'),'donor_activities.currency' )
        // ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
        // ->where('mandat_id', 8)
        // ->groupBy('province_id')->first();
        $peatlandRewetting =  DB::table('donor_activities')->select('donor_activities.id','donor_activities.amount','province_id',DB::raw('SUM(amount) as anggaran'))
        ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
        ->where(function ($query){
            $query->where('donor_activities.currency','=' ,'1')
            ->where('mandat_id','=' ,'8');
        })
        ->groupBy('province_id')->first();
        $collection=collect($peatlandRewetting)->max();
        $respi = ['anggaran'=>$collection];
        return $this->sendData($respi);
    }
    public function administrationManagement(){
        // $peatlandRewetting =  DB::table('donor_activities')->select('donor_activities.id','donor_activities.amount','province_id',DB::raw('SUM(amount) as anggaran'),'donor_activities.currency' )
        // ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
        // ->where('mandat_id', 9)
        // ->groupBy('province_id')->first();
        $peatlandRewetting =  DB::table('donor_activities')->select('donor_activities.id','donor_activities.amount','province_id',DB::raw('SUM(amount) as anggaran'))
        ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
        ->where(function ($query){
            $query->where('donor_activities.currency','=' ,'1')
            ->where('mandat_id','=' ,'9');
        })
        ->groupBy('province_id')->first();
        $collection=collect($peatlandRewetting)->max();
        $respi = ['anggaran'=>$collection];
        return $this->sendData($respi);
    }
    
    public function khg(){
        $peatlandRewetting =  DB::table('donor_activities')->select('donor_activities.id','donor_activities.amount','province_id',DB::raw('SUM(amount) as anggaran'),'donor_activities.currency' )
        ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
        ->where(function ($query){
            $query->where('donor_activities.currency','=' ,'1')
            ->where('mandat_id','=' ,'1');
        })
        ->groupBy('province_id')->first();
        $collection1=collect($peatlandRewetting)->max();

        $revegetation =  DB::table('donor_activities')->select('donor_activities.id','donor_activities.amount','province_id',DB::raw('SUM(amount) as anggaran'),'donor_activities.currency' )
        ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
        ->where(function ($query){
            $query->where('donor_activities.currency','=' ,'1')
            ->where('mandat_id','=' ,'2');
        })
        ->groupBy('province_id')->first();
        $collection2=collect($revegetation)->max();

        $revitalization =  DB::table('donor_activities')->select('donor_activities.id','donor_activities.amount','province_id',DB::raw('SUM(amount) as anggaran'),'donor_activities.currency' )
        ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
        ->where(function ($query){
            $query->where('donor_activities.currency','=' ,'1')
            ->where('mandat_id','=' ,'3');
        })
        ->groupBy('province_id')->first();
        $collection3=collect($revitalization)->max();

        $baseStabilization =  DB::table('donor_activities')->select('donor_activities.id','donor_activities.amount','province_id',DB::raw('SUM(amount) as anggaran'),'donor_activities.currency' )
        ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
        ->where(function ($query){
            $query->where('donor_activities.currency','=' ,'1')
            ->where('mandat_id','=' ,'4');
        })
        ->groupBy('province_id')->first();
        $collection4=collect($baseStabilization)->max();

        $instSrengthening =  DB::table('donor_activities')->select('donor_activities.id','donor_activities.amount','province_id',DB::raw('SUM(amount) as anggaran'),'donor_activities.currency' )
        ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
        ->where(function ($query){
            $query->where('donor_activities.currency','=' ,'1')
            ->where('mandat_id','=' ,'5');
        })
        ->groupBy('province_id')->first();
        $collection5=collect($instSrengthening)->max();

        $coopImprove =  DB::table('donor_activities')->select('donor_activities.id','donor_activities.amount','province_id',DB::raw('SUM(amount) as anggaran'),'donor_activities.currency' )
        ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
        ->where(function ($query){
            $query->where('donor_activities.currency','=' ,'1')
            ->where('mandat_id','=' ,'6');
        })
        ->groupBy('province_id')->first();
        $collection6=collect($coopImprove)->max();

        $actifRoles =  DB::table('donor_activities')->select('donor_activities.id','donor_activities.amount','province_id',DB::raw('SUM(amount) as anggaran'),'donor_activities.currency' )
        ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
        ->where(function ($query){
            $query->where('donor_activities.currency','=' ,'1')
            ->where('mandat_id','=' ,'7');
        })
        ->groupBy('province_id')->first();
        $collection7=collect($actifRoles)->max();

        $peatlandRestoration =  DB::table('donor_activities')->select('donor_activities.id','donor_activities.amount','province_id',DB::raw('SUM(amount) as anggaran'),'donor_activities.currency' )
        ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
        ->where(function ($query){
            $query->where('donor_activities.currency','=' ,'1')
            ->where('mandat_id','=' ,'8');
        })
        ->groupBy('province_id')->first();
        $collection8=collect($peatlandRestoration)->max();

        $administrationManagement =  DB::table('donor_activities')->select('donor_activities.id','donor_activities.amount','province_id',DB::raw('SUM(amount) as anggaran'),'donor_activities.currency' )
        ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
        ->where(function ($query){
            $query->where('donor_activities.currency','=' ,'1')
            ->where('mandat_id','=' ,'9');
        })
        ->groupBy('province_id')->first();
        $collection9=collect($administrationManagement)->max();
     //  $cek = peatlandRewetting();
    //     $setProv = DB::table('donor_activities')
    //         ->select('province_id', DB::raw('sum(amount) as cost'))
    //         ->groupBy('province_id')->whereNotNull('amount')->get();

     //    $targetedMandat = DB::table('m_brg_mandat')->select('desc_en')->get();
 
    // //    $collection = collect([$totalFunding])->collapse();


    //      $collection = collect([$setProv])->collapse();

    //     $totalFunding = $collection->groupBy('province_id')->map(function ($item) {
    //         return $item->sum(function ($item) {
    //             return $item->cost;
    //         });
    //     });

    //     // $total = [];
    //     // foreach(){
            
    //     // }
         $resp = [];

        //  $targetedMandat = DB::table('m_brg_mandat')->select('desc_en')
        //  ->where('id',1)->first();
         for($i=1; $i<10;$i++){
             
         $targetedMandat = DB::table('m_brg_mandat')->select('desc_en')
         ->where('id',$i)->first();
         ${'coll'.$i}=collect($targetedMandat)->max();
         $resp [] = [ 'name' => ${'coll'.$i}, 'value' => ${'collection'.$i} ];
         }
        //  $data=['data'=>$resp];
    //     foreach ($targetedProvinces as $k => $v) {
    //         $value = isset($totalFunding[$v->province_id]) ? $totalFunding[$v->province_id] : null;
    //         $total[$v->short_name] = $value;

    //         $resp[] = [ 'name' => $v->short_name, 'value' => $value ];
    //     }
         return json_encode($resp);
    }
   
    public function costByProvince()
    {
        $setProv = DB::table('donor_activities')
            ->select('province_id', DB::raw('sum(amount) as cost'))
            ->groupBy('province_id')->whereNotNull('amount')->get();

        $targetedProvinces = DB::table('provinces')->where('is_enabled',1)->get();
 
    //    $collection = collect([$totalFunding])->collapse();


         $collection = collect([$setProv])->collapse();

        $totalFunding = $collection->groupBy('province_id')->map(function ($item) {
            return $item->sum(function ($item) {
                return $item->cost;
            });
        });

        // $total = [];
        // foreach(){
            
        // }
        $resp = [];

        foreach ($targetedProvinces as $k => $v) {
            $value = isset($totalFunding[$v->province_id]) ? $totalFunding[$v->province_id] : null;
            $total[$v->short_name] = $value;

            $resp[] = [ 'name' => $v->short_name, 'value' => $value ];
        }
         return json_encode($resp);
        
        //return json_encode($setProv);
    }
    public function costByActivity()
    {
        $peatlandRewetting =  DB::table('donor_activities')->select('donor_activities.id','donor_activities.amount','province_id',DB::raw('SUM(amount) as anggaran'),'donor_activities.currency' )
        ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
        ->where(function ($query){
            $query->where('donor_activities.currency','=' ,'1')
            ->where('mandat_id','=' ,'1');
        })
        ->groupBy('province_id')->first();
        $collection1=collect($peatlandRewetting)->max();

        $revegetation =  DB::table('donor_activities')->select('donor_activities.id','donor_activities.amount','province_id',DB::raw('SUM(amount) as anggaran'),'donor_activities.currency' )
        ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
        ->where(function ($query){
            $query->where('donor_activities.currency','=' ,'1')
            ->where('mandat_id','=' ,'2');
        })
        ->groupBy('province_id')->first();
        $collection2=collect($revegetation)->max();

        $revitalization =  DB::table('donor_activities')->select('donor_activities.id','donor_activities.amount','province_id',DB::raw('SUM(amount) as anggaran'),'donor_activities.currency' )
        ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
        ->where(function ($query){
            $query->where('donor_activities.currency','=' ,'1')
            ->where('mandat_id','=' ,'3');
        })
        ->groupBy('province_id')->first();
        $collection3=collect($revitalization)->max();

        $baseStabilization =  DB::table('donor_activities')->select('donor_activities.id','donor_activities.amount','province_id',DB::raw('SUM(amount) as anggaran'),'donor_activities.currency' )
        ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
        ->where(function ($query){
            $query->where('donor_activities.currency','=' ,'1')
            ->where('mandat_id','=' ,'4');
        })
        ->groupBy('province_id')->first();
        $collection4=collect($baseStabilization)->max();

        $instSrengthening =  DB::table('donor_activities')->select('donor_activities.id','donor_activities.amount','province_id',DB::raw('SUM(amount) as anggaran'),'donor_activities.currency' )
        ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
        ->where(function ($query){
            $query->where('donor_activities.currency','=' ,'1')
            ->where('mandat_id','=' ,'5');
        })
        ->groupBy('province_id')->first();
        $collection5=collect($instSrengthening)->max();

        $coopImprove =  DB::table('donor_activities')->select('donor_activities.id','donor_activities.amount','province_id',DB::raw('SUM(amount) as anggaran'),'donor_activities.currency' )
        ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
        ->where(function ($query){
            $query->where('donor_activities.currency','=' ,'1')
            ->where('mandat_id','=' ,'6');
        })
        ->groupBy('province_id')->first();
        $collection6=collect($coopImprove)->max();

        $actifRoles =  DB::table('donor_activities')->select('donor_activities.id','donor_activities.amount','province_id',DB::raw('SUM(amount) as anggaran'),'donor_activities.currency' )
        ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
        ->where(function ($query){
            $query->where('donor_activities.currency','=' ,'1')
            ->where('mandat_id','=' ,'7');
        })
        ->groupBy('province_id')->first();
        $collection7=collect($actifRoles)->max();

        $peatlandRestoration =  DB::table('donor_activities')->select('donor_activities.id','donor_activities.amount','province_id',DB::raw('SUM(amount) as anggaran'),'donor_activities.currency' )
        ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
        ->where(function ($query){
            $query->where('donor_activities.currency','=' ,'1')
            ->where('mandat_id','=' ,'8');
        })
        ->groupBy('province_id')->first();
        $collection8=collect($peatlandRestoration)->max();

        $administrationManagement =  DB::table('donor_activities')->select('donor_activities.id','donor_activities.amount','province_id',DB::raw('SUM(amount) as anggaran'),'donor_activities.currency' )
        ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
        ->where(function ($query){
            $query->where('donor_activities.currency','=' ,'1')
            ->where('mandat_id','=' ,'9');
        })
        ->groupBy('province_id')->first();
        $collection9=collect($administrationManagement)->max();
     //  $cek = peatlandRewetting();
    //     $setProv = DB::table('donor_activities')
    //         ->select('province_id', DB::raw('sum(amount) as cost'))
    //         ->groupBy('province_id')->whereNotNull('amount')->get();

     //    $targetedMandat = DB::table('m_brg_mandat')->select('desc_en')->get();
 
    // //    $collection = collect([$totalFunding])->collapse();


    //      $collection = collect([$setProv])->collapse();

    //     $totalFunding = $collection->groupBy('province_id')->map(function ($item) {
    //         return $item->sum(function ($item) {
    //             return $item->cost;
    //         });
    //     });

    //     // $total = [];
    //     // foreach(){
            
    //     // }
         $resp = [];

        //  $targetedMandat = DB::table('m_brg_mandat')->select('desc_en')
        //  ->where('id',1)->first();
         for($i=1; $i<10;$i++){
             
         $targetedMandat = DB::table('m_brg_mandat')->select('desc_en')
         ->where('id',$i)->first();
         ${'coll'.$i}=collect($targetedMandat)->max();
         $resp[] = [ 'name' => ${'coll'.$i}, 'value' => ${'collection'.$i} ];
         }
    //     foreach ($targetedProvinces as $k => $v) {
    //         $value = isset($totalFunding[$v->province_id]) ? $totalFunding[$v->province_id] : null;
    //         $total[$v->short_name] = $value;

    //         $resp[] = [ 'name' => $v->short_name, 'value' => $value ];
    //     }
         return json_encode($resp);
        
        //return json_encode($setProv);
    }
    public function totalkegiatan()
    {
        $berdasarKegiatan =  DB::table('donor_activities')
        ->select('donor_activities.id','province_id',DB::raw('COUNT(status) as status') )
        ->where('status',1)->count();
        // $collection=collect($berdasarKegiatan)->first();
        // $resp = ['status'=>$collection];
        $resp = ['status'=>$berdasarKegiatan];
        return $this->sendData($resp);
    }
    public function totallembaga()
    {
        $lembaga =  DB::table('organisasi')
        ->select('id',DB::raw('COUNT(id) as id') )->count();
        // $collection=collect($lembaga)->max();
        // $resp = ['id'=>$collection];
        $resp = ['id'=>$lembaga];
        return $this->sendData($resp);
    }
    public function costKegiatan()
    {
        $setMandat = DB::table('donor_activity_brg_mandat')
            ->select(DB::raw('COUNT(mandat_id) as mandat'),'mandat_id')
            ->groupBy('mandat_id')->get();

        $targetedMandat = DB::table('m_brg_mandat')->select('desc_en')->get();



         $collection = collect([$setMandat])->collapse();

        $totalMandat = $collection->groupBy('mandat_id')->map(function ($item) {
            return $item->sum(function ($item) {
                return $item->mandat;
            });
        });

   
          $resp = [];

        // for($i=1; $i < 10; $i++){

        //     $resp[] = [ 'name' => $i->desc_en, 'value' => 3];
        // }

        foreach ($targetedMandat as $k => $v) {
            $value = isset($totalMandat[$v->mandat_id]) ? $totalMandat[$v->mandat_id] : null;
            $total[$v->desc_en] = $value;

            $resp[] = [ 'name' => $v->desc_en, 'value' => $value ];
        }
      //  return json_encode($resp);
        return json_encode($resp);
    }
    public function berdasarWil()
    {
         $data = '[ 
            "asal":"Wilayah1",
            "value":"500000"
        },
        {
            "asal":"Wilayah2",
            "value":"300000"
        },
        {
            "asal":"Wilayah3",
            "value":"120000"
        },
        {
            "asal":"Wilayah4",
            "value":"340000"
        },
        {
            "asal":"Wilayah5",
            "value":"450000"
        },
        {
            "asal":"Wilayah6",
            "value":"500000"
        }    
        ]'; 
        return $data;
    }
    public function summary()
    {
         $data = '[ 
            "asal":"Lembaga Donor",
            "value":"500000"
        },
        {
            "asal":"Kegiatan",
            "value":"300000"
        },
        {
            "asal":"Kegiatan Progress",
            "value":"120000"
        },
        {
            "asal":"Kegiatan Selesai",
            "value":"340000"
        }           
        ]'; 
        return $data;
    }   
    public function v2provinsi()
    {
        $data = '[ 
            "asal":"Provinsi1",
            "value":"50"
        },
        {
            "asal":"Provinsi2",
            "value":"3"
        },
        {
            "asal":"Provinsi3",
            "value":"12"
        },
        {
            "asal":"Provinsi4",
            "value":"4"
        },
        {
            "asal":"Provinsi5",
            "value":"45"
        },
        {
            "asal":"Provinsi6",
            "value":"10"
        }    
        ]'; 
        return $data;
    }   
    public function v3profile()
    {
        $data = '[ 
            "project":"Peatland Rewetting",
            "value":"500000"
            "asal":"Global Institut"
        },
        {
            "project":"Vegetation Rehabilitation (Revegetation)",
            "value":"300000"
            "asal":"Global Abadi"
        },
        {
            "project":"Socioeconomic Revization of the Community",
            "value":"120000"
            "asal":Abadi Jaya""
        },
        {
            "project":"Peatland Rewetting",
            "value":"340000"
            "asal":"Jaya Bangun"
        },
        {
            "project":"Peatland Rewetting",
            "value":"450000"
            "asal":"Bangun Perkasa"
        },
        {
            "project":"Peatland Rewetting",
            "value":"500000"
            "asal":"Tentram Abadi"
        }    
        ]'; 
        return $data;
    } 

    
    public function costByFundingSource()
    {
        $wellPlan = DB::table('construction_plan')
            ->select('funding_source', DB::raw('sum(cost) as cost'))
            ->groupBy('funding_source')->whereNotNull('cost')->get();

        $canalBlockPlan = DB::table('canal_block_plans')
            ->select('funding_source', DB::raw('sum(cost) as cost'))
            ->groupBy('funding_source')->whereNotNull('cost')->get();

        $canalHoardingPlan = DB::table('canal_hoarding_plans')
            ->select('funding_source', DB::raw('sum(cost) as cost'))
            ->groupBy('funding_source')->whereNotNull('cost')->get();

        $retentionBasinPlan = DB::table('retention_basin_plans')
            ->select('funding_source', DB::raw('sum(cost) as cost'))
            ->groupBy('funding_source')->whereNotNull('cost')->get();

        $revegetationPlan = DB::table('revegetation_plans')
            ->select('funding_source', DB::raw('sum(cost) as cost'))
            ->groupBy('funding_source')->whereNotNull('cost')->get();

        $revitalizationPlan = DB::table('revitalization_plans')
            ->select('funding_source', DB::raw('sum(cost) as cost'))
            ->groupBy('funding_source')->whereNotNull('cost')->get();

        $mFundingSource = DB::table('funding_sources')->get();

        // $canalBlockPlan = DB::table('canal_block_plans as a')
        //     ->select('b.id as funding_source_id', 'b.remark as funding_source', 
        //         DB::raw('sum(cost) as cost'))
        //     ->leftJoin('funding_sources as b', 'a.funding_source', '=', 'b.id')
        //     ->groupBy('a.funding_source')->whereNotNull('a.cost')->get();

        $collection = collect([$wellPlan, $canalBlockPlan, $canalHoardingPlan, $retentionBasinPlan,
            $revegetationPlan, $revitalizationPlan])->collapse();

        $totalFunding = $collection->groupBy('funding_source')->map(function ($item) {
                return $item->sum(function ($item) {
                    return $item->cost;
                });
        });

        // $total = [];
        $resp = [];

        foreach ($mFundingSource as $k => $v) {
            // $total[$v->remark] = $totalFunding[$v->id];
            $value = isset($totalFunding[$v->id]) ? $totalFunding[$v->id] : null;
            $resp[] = [ 'name' => $v->remark, 'value' => $value ];
        }
        // dd($resp);
        return json_encode($resp);
    }



    public function totalArea()
    {
        $revegetationPlan = DB::table('revegetation_plans')->sum('total_area');
        $r21Plan = DB::table('revitalization_plans')->sum('r2_1_ha');
        $r22Plan = DB::table('revitalization_plans')->sum('r2_2_ha');
        $r23Plan = DB::table('revitalization_plans')->sum('r2_3_ha');
        $revitalizationPlan = $r21Plan + $r22Plan + $r23Plan;

        $total = collect([$revegetationPlan, $revitalizationPlan])->sum();

        $resp = [ 'totalArea' => $total ];

        return $this->sendData($resp);
    }



    public function totalAction()
    {
        $wellPlan = DB::table('construction_plan')->count('id');
        $canalBlockPlan = DB::table('canal_block_plans')->count('id');
        $canalHoardingPlan = DB::table('canal_hoarding_plans')->count('id');
        $retentionBasinPlan = DB::table('retention_basin_plans')->count('id');

        $total = collect([$wellPlan, $canalBlockPlan, $canalHoardingPlan, $retentionBasinPlan])->sum();

        $resp = [ 'totalAction' => $total ];

        return $this->sendData($resp);
    }

    public function actionByProvince()
    {
        $wellPlan = DB::table('construction_plan')
            ->select('province_id', DB::raw('count(id) as action'))->groupBy('province_id')->get();

        $canalBlockPlan = DB::table('canal_block_plans')
            ->select('province_id', DB::raw('count(id) as action'))->groupBy('province_id')->get();

        $canalHoardingPlan = DB::table('canal_hoarding_plans')
            ->select('province_id', DB::raw('count(id) as action'))->groupBy('province_id')->get();

        $retentionBasinPlan = DB::table('retention_basin_plans')
            ->select('province_id', DB::raw('count(id) as action'))->groupBy('province_id')->get();

        $targetedProvinces = DB::table('provinces')->where('is_enabled',1)->get();

        $collection = collect([$wellPlan, $canalBlockPlan, $canalHoardingPlan, $retentionBasinPlan])->collapse();

        $totalAction = $collection->groupBy('province_id')->map(function ($item) {
            return $item->sum(function ($item) {
                return $item->action;
            });
        });

        $resp = [];

        foreach ($targetedProvinces as $k => $v) {
            $value = isset($totalAction[$v->province_id]) ? $totalAction[$v->province_id] : null;
            $resp[] = [ 'name' => $v->short_name, 'value' => $value ];
        }
        return json_encode($resp);
    }  
}
