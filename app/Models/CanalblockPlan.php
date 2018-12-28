<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTrait;
use App\Models\CanalblockImpl;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use DB;

class CanalblockPlan extends Model  implements HasMedia {
    use HasMediaTrait, ModelTrait;
    
    protected $table = 'canal_block_plans';
    protected $fillable = [
        'name',
        'code',
        'canal_type',
        'canal_blocking_type',
        'phu_id',
        'province_id',
        'city_id',
        'sub_district_id',
        'village',
        'remark',
        'year',
        'unit',
        'status',
        'cost',
        'funding_source',
        'uprg_text',
        'uprg_slug',
        'uprg_id',
        'lat',
        'lng',
    ];
    protected $spatialFields = [
        'coordinate'
    ];
    protected $appends = ['administrative_area'];
    public $timestamps = true;
    protected $hidden = [
        'province_id', 'city_id','sub_district_id','village','status', 'media'
    ];
    private $rule_validate = [
        'generalActivity' => 'required',
        'generalActivity.name' => 'required',
        'generalActivity.code' => 'required',
        'generalActivity.canalType' => 'required',
        'generalActivity.canalType.id' => 'required|in:2',
        'generalActivity.canalBlockingType' => 'required',
        'generalActivity.canalBlockingType.id' => 'required|in:2',
        'generalActivity.unit' => 'required',
        'generalActivity.remark' => 'required',
        'generalActivity.administrativeArea' => 'required',
        'generalActivity.administrativeArea.province' => 'required',
        'generalActivity.administrativeArea.province.provinceId' => 'required',
        'generalActivity.administrativeArea.city' => 'required',
        'generalActivity.administrativeArea.city.cityId' => 'required',
        'generalActivity.administrativeArea.subDistrict' => 'required',
        'generalActivity.administrativeArea.subDistrict.id' => 'required',
        'generalActivity.administrativeArea.village' => 'required',
        'generalActivity.phu' => 'required',
        'generalActivity.phu.id' => 'required',
        'generalActivity.year' => 'required',
        'generalActivity.cost' => 'required',
        'generalActivity.fundingSource' => 'required',
        'generalActivity.fundingSource.id' => 'required',
        'generalActivity.uprgText' => 'required',
        'generalActivity.uprgSlug' => 'required',
        'generalActivity.uprgId' => 'required',
        'generalActivity.lat' => 'required',
        'generalActivity.lng' => 'required',
//        'generalActivity.status' => 'required',
//        'generalActivity.status.id' => 'required',
    ];
    
    public function registerMediaCollections()
    {
        foreach (config('app.image-media-collection') as $collection) {
            $this->addMediaCollection($collection)->singleFile();
        }
        $this->addMediaCollection('document');
    }
    
    public function status()
    {
        return $this->belongsTo(\App\Models\Status::class,'status');
    }
    
    public function canalType()
    {
        return $this->belongsTo(\App\Models\CanalType::class,'canal_type');
    }
    
    public function canalBlockingType()
    {
        return $this->belongsTo(\App\Models\CanalBlockingType::class,'canal_blocking_type');
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
    
    public function phu()
    {
        return $this->belongsTo(\App\Models\PeatHydrologicalUnity::class,'phu_id');
    }

    public function fundingSource()
    {
        return $this->belongsTo(\App\Models\FundingSources::class, 'funding_source');
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
    
    public function add($params) {
        $generalActivity = $params->generalActivity;
        $canalType = $generalActivity['canalType'];
        $canalBlockingType = $generalActivity['canalBlockingType'];
        $fundingSource = $generalActivity['fundingSource'];
        
        $administrativeArea = $generalActivity['administrativeArea'];
        $province = $administrativeArea['province'];
        $city = $administrativeArea['city'];
        $subDistrict = $administrativeArea['subDistrict'];
        
        $phu = $generalActivity['phu'];
        $year = $generalActivity['year'];
        
         
        $data = [
            'name' => $generalActivity['name'],
            'code' => $generalActivity['code'],
            'canal_type' => $canalType['id'],
            'canal_blocking_type' => $canalBlockingType['id'],
            'unit' => $generalActivity['unit'],
            'remark' => $generalActivity['remark'],
            'province_id' => $province['provinceId'],
            'city_id' => $city['cityId'],
            'sub_district_id' => $subDistrict['id'],
            'village' => $administrativeArea['village'],
            'phu_id' => $phu['id'],
            'year' => $year,
            'status' => 1,
            'cost' => $generalActivity['cost'],
            'funding_source' => $generalActivity['fundingSource'],
            'uprg_text' => $generalActivity['uprgText'],
            'uprg_slug' => $generalActivity['uprgSlug'],
            'uprg_id' => $generalActivity['uprgId'],
            'lat' => $generalActivity['lat'],
            'lng' => $generalActivity['lng'],
        ];
        
        $new = $this->create($data);

        return $new;
    }
    
    public function ubah($params) {
        $generalActivity = $params->generalActivity;
        $canalType = $generalActivity['canalType'];
        $canalBlockingType = $generalActivity['canalBlockingType'];
        $fundingSource = $generalActivity['fundingSource'];
        
        $administrativeArea = $generalActivity['administrativeArea'];
        $province = $administrativeArea['province'];
        $city = $administrativeArea['city'];
        $subDistrict = $administrativeArea['subDistrict'];
        
        $phu = $generalActivity['phu'];
        $year = $generalActivity['year'];
        
        
        $data = [
            'name' => $generalActivity['name'],
            'code' => $generalActivity['code'],
            'canal_type' => $canalType['id'],
            'canal_blocking_type' => $canalBlockingType['id'],
            'unit' => $generalActivity['unit'],
            'remark' => $generalActivity['remark'],
            'province_id' => $province['provinceId'],
            'city_id' => $city['cityId'],
            'sub_district_id' => $subDistrict['id'],
            'village' => $administrativeArea['village'],
            'phu_id' => $phu['id'],
            'year' => $year,
            'cost' => $generalActivity['cost'],
            'funding_source' => $fundingSource['id'],
            'uprg_text' => $generalActivity['uprgText'],
            'uprg_slug' => $generalActivity['uprgSlug'],
            'uprg_id' => $generalActivity['uprgId'],
            'lat' => $generalActivity['lat'],
            'lng' => $generalActivity['lng'],
        ];
       
        $new = $this->whereId($params->id)->update($data);
            
        return $new;
    }
    
    public function updateStatus($params) {
        	
        $data = [
            'status' => $params->status,
        ];
       
        // DB::beginTransaction();
        
        // try {
            $new = $this->whereId($params->id)->update($data);
            $impl = new CanalblockImpl;
            $plan = $this->find($params->id);
            $impl->add($plan);
        //     DB::commit();
        // } catch (\Exception $e) {
        //     DB::rollback();
        //     return null;
        // }
        return $new;
    }
    
}
