<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use DB;

class RevitalizationPlan extends Model  implements HasMedia {
    use HasMediaTrait, ModelTrait;
    
    protected $table = 'revitalization_plans';
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
        'r1_1_unit',
        'r1_2_unit',
        'r1_3_m',
        'r1_4_unit',
        'r2_1_ha',
        'r2_2_ha',
        'r2_3_ha',
        'year',
        'remark',
        'lat',
        'lng',
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
        'generalActivity.fundingSource' => 'required',
        'generalActivity.fundingSource.id' => 'required',
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
       'generalActivity.r11Unit' => 'required',
        'generalActivity.r12Unit' => 'required',
        'generalActivity.r13M' => 'required',
        'generalActivity.r14Unit' => 'required',
        'generalActivity.r21Ha' => 'required',
        'generalActivity.r22Ha' => 'required',
        'generalActivity.r23Ha' => 'required',
        'generalActivity.lat' => 'required',
        'generalActivity.lng' => 'required',
        'generalActivity.uprgText' => 'required',
        'generalActivity.uprgSlug' => 'required',
        'generalActivity.uprgId' => 'required',
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
    
    public function fundingSource()
    {
        return $this->belongsTo(\App\Models\FundingSources::class,'funding_source');
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
        $year = $generalActivity['year'];
        
         
        $data = [
            'name' => $generalActivity['name'],
            'code' => $generalActivity['code'],
            'cost' => $generalActivity['cost'],
            'funding_source' => $fundingSource['id'],
            'remark' => $generalActivity['remark'],
            'province_id' => $province['provinceId'],
            'city_id' => $city['cityId'],
            'sub_district_id' => $subDistrict['id'],
            'village' => $administrativeArea['village'],
            'phu_id' => $phu['id'],
            'year' => $year,
            'r1_1_unit' => $generalActivity['r11Unit'],
            'r1_2_unit' => $generalActivity['r12Unit'],
            'r1_3_m' => $generalActivity['r13M'],
            'r1_4_unit' => $generalActivity['r14Unit'],
            'r2_1_ha' => $generalActivity['r21Ha'],
            'r2_2_ha' => $generalActivity['r22Ha'],
            'r2_3_ha' => $generalActivity['r23Ha'],
            'lat' => $generalActivity['lat'],
            'lng' => $generalActivity['lng'],
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
        $year = $generalActivity['year'];
        
        
        $data = [
             'name' => $generalActivity['name'],
            'code' => $generalActivity['code'],
            'cost' => $generalActivity['cost'],
            'funding_source' => $fundingSource['id'],
            'remark' => $generalActivity['remark'],
            'province_id' => $province['provinceId'],
            'city_id' => $city['cityId'],
            'sub_district_id' => $subDistrict['id'],
            'village' => $administrativeArea['village'],
            'phu_id' => $phu['id'],
            'year' => $year,
            'r1_1_unit' => $generalActivity['r11Unit'],
            'r1_2_unit' => $generalActivity['r12Unit'],
            'r1_3_m' => $generalActivity['r13M'],
            'r1_4_unit' => $generalActivity['r14Unit'],
            'r2_1_ha' => $generalActivity['r21Ha'],
            'r2_2_ha' => $generalActivity['r22Ha'],
            'r2_3_ha' => $generalActivity['r23Ha'],
            'lat' => $generalActivity['lat'],
            'lng' => $generalActivity['lng'],
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
            $impl = new RevitalizationImpl;
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
