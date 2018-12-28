<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use DB;

class RetentionBasinImpl extends Model  implements HasMedia {
    use HasMediaTrait, ModelTrait;
    
    protected $table = 'retention_basin_impl';
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
        'province_id', 'city_id','sub_district_id','village','status', 'media', 'implProgress'
    ];
    private $rule_validate = [
        'generalActivity' => 'required',
        'generalActivity.name' => 'required',
        'generalActivity.code' => 'required',
        'generalActivity.cost' => 'required',
        'generalActivity.fundingSource' => 'required',
        'generalAcitivy.fundingSource.id' => 'required',
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
        'generalActivity.uprg_text' => 'required',
        'generalActivity.uprg_slug' => 'required',
        'generalActivity.uprg_id' => 'required',
        
    ];
    
    public function implProgress()
    {
        return $this->morphMany('App\Models\ImplProgress', 'activity', 'activity_type', 'impl_id');
    }
    
    public function retentionBasinDetail()
    {
        return $this->belongsTo(\App\Models\RetentionBasinDetail::class,'id','activity_id');
    }
    
    public function registerMediaCollections()
    {
        foreach (config('app.image-media-collection') as $collection) {
            $this->addMediaCollection($collection)->singleFile();
        }
        $this->addMediaCollection('galery');
        $this->addMediaCollection('document');
    }
    
    public function status()
    {
        return $this->belongsTo(\App\Models\ImplStatus::class,'status');
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
    
    public function add($plan) {
        
        $data = [
            'plan_id' => $plan->id,
            'name' => $plan->name,
            'code' => $plan->code,
            'cost' => $plan->cost,
            'funding_source' => $plan->funding_source,
            'phu_id' => $plan->phu_id,
            'province_id' => $plan->province_id,
            'city_id' => $plan->city_id,
            'sub_district_id' => $plan->sub_district_id,
            'village' => $plan->village,
            'remark' => $plan->remark,
            'year' => $plan->year,
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
