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
$peatlandRewetting =  DB::table('donor_activities')
                        ->select('donor_activities.id','donor_activities.amount','donor_activities.province_id',DB::raw('SUM(amount) as anggaran'),'donor_activities.currency' )
                        ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
                        ->where('mandat_id', 1)
                        ->groupBy('province_id')->get()->toArray();
$revegetation =  DB::table('donor_activities')
                        ->select('donor_activities.id','donor_activities.amount','donor_activities.province_id',DB::raw('SUM(amount) as anggaran'),'donor_activities.currency')
                        ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
                        ->where('mandat_id', 2)
                        ->groupBy('province_id')->get()->toArray();
$revitalization =  DB::table('donor_activities')
                        ->select('donor_activities.id','donor_activities.amount','donor_activities.province_id',DB::raw('SUM(amount) as anggaran'),'donor_activities.currency')
                        ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
                        ->where('mandat_id', 3)
                        ->groupBy('province_id')->get()->toArray();
$baseStabilization =  DB::table('donor_activities')
                        ->select('donor_activities.id','donor_activities.amount','donor_activities.province_id',DB::raw('SUM(amount) as anggaran'),'donor_activities.currency')
                        ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
                        ->where('mandat_id', 4)
                        ->groupBy('province_id')->get()->toArray();
$instStrengthening =  DB::table('donor_activities')
                        ->select('donor_activities.id','donor_activities.amount','donor_activities.province_id',DB::raw('SUM(amount) as anggaran'),'donor_activities.currency')
                        ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
                        ->where('mandat_id', 5)
                        ->groupBy('province_id')->get()->toArray();
$coopImprove =  DB::table('donor_activities')
                        ->select('donor_activities.id','donor_activities.amount','donor_activities.province_id',DB::raw('SUM(amount) as anggaran'),'donor_activities.currency')
                        ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
                        ->where('mandat_id', 6)
                        ->groupBy('province_id')->get()->toArray();
$actifRoles =  DB::table('donor_activities')
                        ->select('donor_activities.id','donor_activities.amount','donor_activities.province_id',DB::raw('SUM(amount) as anggaran'),'donor_activities.currency')
                        ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
                        ->where('mandat_id', 7)
                        ->groupBy('province_id')->get()->toArray();
$peatlandRestoration =  DB::table('donor_activities')
                        ->select('donor_activities.id','donor_activities.amount','donor_activities.province_id',DB::raw('SUM(amount) as anggaran'),'donor_activities.currency')
                        ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
                        ->where('mandat_id', 8)
                        ->groupBy('province_id')->get()->toArray();
$adminstrartionManagement =  DB::table('donor_activities')
                        ->select('donor_activities.id','donor_activities.amount','donor_activities.province_id',DB::raw('SUM(amount) as anggaran'),'donor_activities.currency')
                        ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
                        ->where('mandat_id', 9)
                        ->groupBy('province_id')->get()->toArray();
    
        $collection = collect([$peatlandRewetting, $revegetation, $revitalization, $baseStabilization, $instStrengthening, $coopImprove, $actifRoles, $peatlandRestoration, $adminstrartionManagement ]);
        $allCost = $collection->collapse();
        $prov = [];
        $total_anggaran = 0;
        foreach ($allCost->all() as $ang){
            // $province_id = $ang['province']
            // $province_id = $ang['administrative_area']['province']->province_id;
            // $prov[$province_id] = [
            //     'anggaran' => (isset($prov[$province_id]['anggaran']) ? $prov[$province_id]['anggaran'] : 0) + $ang['amount'],
            //     'province' => $ang['administrative_area']['province'],
            // ];
            // $total_anggaran += isset($prov[$province_id]['anggaran']) ? $prov[$province_id]['anggaran'] : 0;
        }
        
        // $resp = [];
        // foreach ($prov as $p) {
        //     $resp[] = [
        //         'anggaran' => $p['anggaran'],
        //         'persen' => $total_anggaran ? 100 * ($p['anggaran']/$total_anggaran ) : 0,
        //         'province' => $p['province']->long_name,
        //     ];
        // }
        
        return $this->sendData( $allCost->all());
      //  return $this->sendData($resp);
    }
    public function berdasarkegiatan()
    {
         $data = '[ 
            "asal":"Kegiatan1",
            "value":"500000"
        },
        {
            "asal":"Kegiatan2",
            "value":"300000"
        },
        {
            "asal":"Kegiatan3",
            "value":"120000"
        },
        {
            "asal":"Kegiatan4",
            "value":"340000"
        },
        {
            "asal":"Kegiatan5",
            "value":"450000"
        },
        {
            "asal":"Kegiatan6",
            "value":"500000"
        }    
        ]'; 
        return $data;
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
}
