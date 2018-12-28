<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTrait;
use App\Models\RetentionBasinImpl;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use DB;

class RetentionBasinPlan extends Model  implements HasMedia {
    use HasMediaTrait, ModelTrait;
    
    protected $table = 'retention_basin_plans';
    protected $fillable = [
        'name',
        'code',
        'cost',
        'funding_source',
        'phu_id',
        'province_id',
        'city_id',
        'sub_district_id',
        'village',
        'remark',
        'year',
        'uprg_text',
        'uprg_slug',
        'uprg_id',
        'status',
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
        'generalActivity.cost' => 'required',
        'generalActivity.fundingSource' => 'required',
        'generalActivity.fundingSource.id' => 'required',
        'generalActivity.phu' => 'required',
        'generalActivity.phu.id' => 'required',
        'generalActivity.administrativeArea' => 'required',
        'generalActivity.administrativeArea.province' => 'required',
        'generalActivity.administrativeArea.province.provinceId' => 'required',
        'generalActivity.administrativeArea.city' => 'required',
        'generalActivity.administrativeArea.city.cityId' => 'required',
        'generalActivity.administrativeArea.subDistrict' => 'required',
        'generalActivity.administrativeArea.subDistrict.id' => 'required',
        'generalActivity.administrativeArea.village' => 'required',
        'generalActivity.remark' => 'required',
        'generalActivity.year' => 'required',
        'generalActivity.uprgText' => 'required',
        'generalActivity.uprgSlug' => 'required',
        'generalActivity.uprgId' => 'required',
        
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
        
        $fundingSource = $generalActivity['fundingSource'];
        
        $administrativeArea = $generalActivity['administrativeArea'];
        $province = $administrativeArea['province'];
        $city = $administrativeArea['city'];
        $subDistrict = $administrativeArea['subDistrict'];
        
        $phu = $generalActivity['phu'];
        
        $data = [
            'name' => $generalActivity['name'],
            'code' => $generalActivity['code'],
            'cost' => $generalActivity['cost'],
            'funding_source' => $fundingSource['id'],
            'phu_id' => $phu['id'],
            'province_id' => $province['provinceId'],
            'city_id' => $city['cityId'],
            'sub_district_id' => $subDistrict['id'],
            'village' => $administrativeArea['village'],
            'remark' => $generalActivity['remark'],
            'year' => $generalActivity['year'],
            'uprg_text' => $generalActivity['uprgText'],
            'uprg_slug' => $generalActivity['uprgSlug'],
            'uprg_id' => $generalActivity['uprgId'],
            'status' => 1,
        ];
        
        $new = $this->create($data);

        return $new;
    }
    
    public function ubah($params) {
        $generalActivity = $params->generalActivity;
        
        $fundingSource = $generalActivity['fundingSource'];
        
        $administrativeArea = $generalActivity['administrativeArea'];
        $province = $administrativeArea['province'];
        $city = $administrativeArea['city'];
        $subDistrict = $administrativeArea['subDistrict'];
        
        $phu = $generalActivity['phu'];
        
        
        $data = [
            'name' => $generalActivity['name'],
            'code' => $generalActivity['code'],
            'cost' => $generalActivity['cost'],
            'funding_source' => $fundingSource['id'],
            'phu_id' => $phu['id'],
            'province_id' => $province['provinceId'],
            'city_id' => $city['cityId'],
            'sub_district_id' => $subDistrict['id'],
            'village' => $administrativeArea['village'],
            'remark' => $generalActivity['remark'],
            'year' => $generalActivity['year'],
            'uprg_text' => $generalActivity['uprgText'],
            'uprg_slug' => $generalActivity['uprgSlug'],
            'uprg_id' => $generalActivity['uprgId'],
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
            $impl = new RetentionBasinImpl;
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
