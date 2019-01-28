<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use DB;

class DonorDash extends Model implements HasMedia
{
    use HasMediaTrait, ModelTrait;
    protected $table = 'donor_activities';
    protected $fillable = [
        'title',
        'summary',
        'start_date',
        'end_date',
        'amount',
        'currency',
        'funding_source',
        'implementing_agency',
        'remark',
        'year',
        'province_id',
        'city_id',
        'sub_district_id',
        'village',
        'x',
        'y',
        'status',
    ];
    protected $appends = ['administrative_area'];
    public $timestamps = true;
    protected $hidden = [
        'province_id', 'city_id','sub_district_id','village',
    ];
    private $rule_validate = [
        'title' => 'required',
        'currency' => 'required',
        'currency.id' => 'required',
        'fundingSource' => '',
        'fundingSource.id' => '',
        'implementingAgency' => 'required',
        'implementingAgency.id' => 'required',
        'remark' => '',
        'year' => '',
        'startDate' => '',
        'endDate' => '',
        'administrativeArea' => 'required',
        'administrativeArea.province' => 'required',
        'administrativeArea.province.provinceId' => 'required',
        'administrativeArea.city' => '',
        'administrativeArea.city.cityId' => '',
        'administrativeArea.subDistrict' => '',
        'administrativeArea.subDistrict.id' => '',
        'administrativeArea.village' => '',
        // 'x' => 'required',
        // 'y' => 'required',
    ];
    
    public function brgMandat()
    {
        return $this->belongsToMany(\App\Models\MBrgMandat::class,'donor_activity_brg_mandat','project_id','mandat_id');
    }
    
    
    public function phu()
    {
        return $this->belongsToMany(\App\Models\PeatHydrologicalUnity::class,'donor_activity_phu','project_id','phu_id');
    }
    
    public function status()
    {
        return $this->belongsTo(\App\Models\MDonorActivityStatuses::class,'status');
    }
    
    public function fundingSource()
    {
        return $this->belongsTo(\App\Models\Organizations::class,'funding_source');
    }
    
    
    public function implementingAgency()
    {
        return $this->belongsTo(\App\Models\Organizations::class,'implementing_agency');
    }
    
    public function currency()
    {
        return $this->belongsTo(\App\Models\MCurrency::class,'currency');
    }
    
    public function province()
    {
        return $this->belongsTo(\App\Models\Province::class,'province_id');
    }
    
    public function city()
    {
        return $this->belongsTo(\App\Models\City::class,'city_id');
    }
    
    public function subDistrict()
    {
        return $this->belongsTo(\App\Models\SubDistrict::class,'sub_district_id');
    }
    
    public function getAdministrativeAreaAttribute($value)
    {
        return [
            'province' => $this->province()->first(),
            'city' => $this->city()->first(),
            'subDistrict' => $this->subDistrict()->first(),
            'village' => $this->village,
        ];
    }
    
    public function updateStatus($params) {
        	
        $data = [
            'status' => $params->status,
        ];
       
        $new = $this->whereId($params->id)->update($data);
          
        return $new;
    }
}
