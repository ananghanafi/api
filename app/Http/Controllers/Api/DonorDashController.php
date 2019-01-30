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
//                         ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
//                         ->where('mandat_id', 5)
//                         ->groupBy('province_id')->get()->toArray();
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
//         $collection = collect([$peatlandRewetting, $revegetation, $revitalization, $baseStabilization, $instStrengthening, $coopImprove, $actifRoles, $peatlandRestoration, $adminstrartionManagement ]);
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
    public function peatlandrewetting(){
        // $model = new DonorDash;
        // $peatlandRewetting = DB::table('donor_activities')->sum('amount');
        // $peatlandRewetting =  DonorDash::select('donor_activities.id','donor_activities.amount','province_id',DB::raw('SUM(amount) as anggaran'),'donor_activities.currency' )
        //                 ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
        //                 ->where('mandat_id', 1)
        //                 ->groupBy('province_id')->get()->toArray();
        $peatlandRewetting =  DB::table('donor_activities')->select('donor_activities.id','donor_activities.amount','province_id',DB::raw('SUM(amount) as anggaran'),'donor_activities.currency' )
        ->join('donor_activity_brg_mandat','donor_activity_brg_mandat.project_id','=','donor_activities.id')
        ->where('mandat_id', 1)
        ->groupBy('province_id')->first();
        // $dsds=2323;
        $collection=collect($peatlandRewetting)->max();
    //    $cek= $collection->collapse();
    //     $dsd='anggaran';
        $respi = ['anggaran'=>$collection];
        return $this->sendData($respi);

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
    public function totalcost()
    {
        // $wellPlan = DB::table('construction_plan')->sum('cost');
        // $canalBlockPlan = DB::table('canal_block_plans')->sum('cost');
        // $canalHoardingPlan = DB::table('canal_hoarding_plans')->sum('cost');
        // $retentionBasinPlan = DB::table('retention_basin_plans')->sum('cost');
        // $revegetationPlan = DB::table('revegetation_plans')->sum('cost');
        // $revitalizationPlan = DB::table('revitalization_plans')->sum('cost');

        // $total = collect([$wellPlan, $canalBlockPlan, $canalHoardingPlan, $retentionBasinPlan,
        //     $revegetationPlan, $revitalizationPlan])->sum();

        // $resp = [ 'totalCost' => $total ];

        // return $this->sendData($resp);
$peatlandRewetting =  DB::table('donor_activities')->sum('amount');
$peatlandRewetting2 =  DB::table('donor_activities')->sum('amount');
$total = collect([$peatlandRewetting, $peatlandRewetting2])->sum()->get();

        $resp = [ 'totalcost' => $total];

         return $this->sendData($resp);
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

    public function costByProvince()
    {
        $wellPlan = DB::table('construction_plan')
            ->select('province_id', DB::raw('sum(cost) as cost'))
            ->groupBy('province_id')->whereNotNull('cost')->get();

        $canalBlockPlan = DB::table('canal_block_plans')
            ->select('province_id', DB::raw('sum(cost) as cost'))
            ->groupBy('province_id')->whereNotNull('cost')->get();

        $canalHoardingPlan = DB::table('canal_hoarding_plans')
            ->select('province_id', DB::raw('sum(cost) as cost'))
            ->groupBy('province_id')->whereNotNull('cost')->get();

        $retentionBasinPlan = DB::table('retention_basin_plans')
            ->select('province_id', DB::raw('sum(cost) as cost'))
            ->groupBy('province_id')->whereNotNull('cost')->get();

        $revegetationPlan = DB::table('revegetation_plans')
            ->select('province_id', DB::raw('sum(cost) as cost'))
            ->groupBy('province_id')->whereNotNull('cost')->get();

        $revitalizationPlan = DB::table('revitalization_plans')
            ->select('province_id', DB::raw('sum(cost) as cost'))
            ->groupBy('province_id')->whereNotNull('cost')->get();

        $targetedProvinces = DB::table('provinces')->where('is_enabled',1)->get();

        $collection = collect([$wellPlan, $canalBlockPlan, $canalHoardingPlan, $retentionBasinPlan,
            $revegetationPlan, $revitalizationPlan])->collapse();

        $totalFunding = $collection->groupBy('province_id')->map(function ($item) {
            return $item->sum(function ($item) {
                return $item->cost;
            });
        });

        // $total = [];
        $resp = [];

        foreach ($targetedProvinces as $k => $v) {
            $value = isset($totalFunding[$v->province_id]) ? $totalFunding[$v->province_id] : null;
            // $total[$v->short_name] = $value;
            $resp[] = [ 'name' => $v->short_name, 'value' => $value ];
        }
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

    public function areaByProvince()
    {
        $revegetationPlan = DB::table('revegetation_plans')
            ->select('province_id', DB::raw('sum(total_area) as total_area'))
            ->groupBy('province_id')->get();

        $r21Plan = DB::table('revitalization_plans')
            ->select('province_id', DB::raw('sum(r2_1_ha) as total_area'))
            ->groupBy('province_id')->get();

        $r22Plan = DB::table('revitalization_plans')
            ->select('province_id', DB::raw('sum(r2_1_ha) as total_area'))
            ->groupBy('province_id')->get();

        $r23Plan = DB::table('revitalization_plans')
            ->select('province_id', DB::raw('sum(r2_3_ha) as total_area'))
            ->groupBy('province_id')->get();

        $targetedProvinces = DB::table('provinces')->where('is_enabled',1)->get();

        $collection = collect($revegetationPlan, $r21Plan, $r22Plan, $r23Plan);

        $totalArea = $collection->groupBy('province_id')->map(function ($item) {
            return $item->sum(function ($item) {
                return $item->total_area;
            });
        });

        $resp = [];

        foreach ($targetedProvinces as $k => $v) {
            $value = isset($totalArea[$v->province_id]) ? $totalArea[$v->province_id] : null;
            $resp[] = [ 'name' => $v->short_name, 'value' => $value ];
        }
        return json_encode($resp);
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
