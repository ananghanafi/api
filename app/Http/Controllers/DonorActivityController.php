<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DonorActivity;
use App\Models\DonorDash;
use DB;

class DonorActivityController extends Controller
{
    public function index() {
        $model = new DonorActivity;
        $da = $model->get();
        // return $da;
        return view('donor-activity', ['da' => $da]);
    }
    public function store(){
        $model = new DonorActivity;
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
    public function report() {
        $model = new DonorActivity;
        $da = $model->get();
        // return $da;
        return view('report-donor', ['da' => $da]);
    }
    public function add() {
        $model = new DonorActivity;
        $da = $model->get();
        // return $da;
        return view('add-donor', ['da' => $da]);
    }
    public function activity() {
        $model = new DonorActivity;
        $da = $model->get();
        // return $da;
        return view('add-donor-activity', ['da' => $da]);
    }
    // public function anggaran(){

    //  return view('donor-activity', ['da'=>$peatlandRewetting]);
    // }
}
