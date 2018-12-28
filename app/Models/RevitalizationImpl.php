<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class RevitalizationImpl extends Model implements HasMedia {
    use HasMediaTrait, ModelTrait;
    
    protected $table = 'revitalization_impl';
    protected $fillable = [
        'plan_id',
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
        'province_id', 'city_id','sub_district_id','village','status', 'media', 'implProgress'
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
    
    public function implProgress()
    {
        return $this->morphMany('App\Models\ImplProgress', 'activity', 'activity_type', 'impl_id');
    }
    
    public function revitalizationDetail()
    {
        return $this->belongsTo(\App\Models\RevitalizationDetail::class,'id','activity_id');
    }
    
    public function registerMediaCollections()
    {
        foreach (config('app.image-media-collection') as $collection) {
            $this->addMediaCollection($collection)->singleFile();
        }
        $this->addMediaCollection('document');
        $this->addMediaCollection('galery');
    }
    
    public function status()
    {
        return $this->belongsTo(\App\Models\ImplStatus::class,'status');
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
    
    public function add($plan) {
        $data = [
            'plan_id' => $plan->id,
            'name' => $plan->name,
            'code' => $plan->code,
            'cost' => $plan->cost,
            'funding_source' => $plan->funding_source,
            'remark' => $plan->remark,
            'province_id' => $plan->province_id,
            'city_id' => $plan->city_id,
            'sub_district_id' => $plan->sub_district_id,
            'village' => $plan->village,
            'phu_id' => $plan->phu_id,
            'year' => $plan->year,
            'r1_1_unit' => $plan->r1_1_unit,
            'r1_2_unit' => $plan->r1_2_unit,
            'r1_3_m' => $plan->r1_3_m,
            'r1_4_unit' => $plan->r1_4_unit,
            'r2_1_ha' => $plan->r2_1_ha,
            'r2_2_ha' => $plan->r2_2_ha,
            'r2_3_ha' => $plan->r2_3_ha,
            'lat' => $plan->lat,
            'lng' => $plan->lng,
            'uprg_text' => $plan->uprg_text,
            'uprg_slug' => $plan->uprg_slug,
            'uprg_id' => $plan->uprg_id,
            'status' => 1,
        ];
        
        $new = $this->create($data);
        $files = $plan->getFiles(true);
        foreach ($files['document'] as $media) {
            $new->addMedia($media['path'])->toMediaCollection('document');
        }
        foreach (config('app.image-media-collection') as $collection) {
            foreach ($files[$collection] as $media) {
                $new->addMedia($media['path'])->toMediaCollection($collection);
            }
        }
        foreach ($files['galery'] as $media) {
            $new->addMedia($media['path'])->toMediaCollection('galery');
        }
        
        return $new;
    }
    
    public function ubah($params, $modelDetail) {
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
       
        $dataDetail = $this->camelToSnake($params->detailActivity);
        DB::beginTransaction();
//        
        try {
            $new = $this->whereId($params->id)->update($data);
            $new_detail = $modelDetail->updateOrCreate(['activity_id' => $params->id], array_merge(['activity_id' => $params->id],$dataDetail));
            
            if (!$new_detail) {
                return null;
            }
            
            
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        return $new;
            
    }
    
    
}
