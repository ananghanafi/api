<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ControllerTrait;
use App\Models\DonorDash;
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
    
    public function anggaran()
    {
         $data = '[ 
            "project":"Peatland Rewetting",
            "value":"500000"
        },
        {
            "project":"Vegetation Rehabilitation (Revegetation)",
            "value":"300000"
        },
        {
            "project":"Socioeconomic Revization of the Community",
            "value":"120000"
        },
        {
            "project":"Peatland Rewetting",
            "value":"340000"
        },
        {
            "project":"Peatland Rewetting",
            "value":"450000"
        },
        {
            "project":"Peatland Rewetting",
            "value":"500000"
        }    
        ]'; 
        return $data;
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
