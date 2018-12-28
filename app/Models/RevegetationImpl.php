<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use DB;

class RevegetationImpl extends Model  implements HasMedia {
    use HasMediaTrait, ModelTrait;
    
    protected $table = 'revegetation_impl';
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
        'burn_status',
        'vegetation_density',
        'revegetation_type',
        'total_area',
        'remark',
        'year',
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
        'generalActivity.year' => 'required',
//        'generalActivity.status' => 'required',
//        'generalActivity.status.id' => 'required',
    ];
    
    public function implProgress()
    {
        return $this->morphMany('App\Models\ImplProgress', 'activity', 'activity_type', 'impl_id');
    }
    
    public function revegetationDetail()
    {
        return $this->belongsTo(\App\Models\RevegetationDetail::class,'id','activity_id');
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
    
    public function fundingSource()
    {
        return $this->belongsTo(\App\Models\FundingSources::class,'funding_source');
    }
    
    public function burnStatus()
    {
        return $this->belongsTo(\App\Models\BurnStatus::class,'burn_status');
    }
    
    public function revegetationType()
    {
        return $this->belongsTo(\App\Models\RevegetationType::class,'revegetation_type');
    }
    
    public function vegetationDensity()
    {
        return $this->belongsTo(\App\Models\VegetationDensity::class,'vegetation_density');
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
            'burn_status' => $plan->burn_status,
            'vegetation_density' => $plan->vegetation_density,
            'revegetation_type' => $plan->revegetation_type,
            'year' => $plan->year,
            'total_area' => $plan->total_area,
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
        $burnStatus = $generalActivity['burnStatus'];
        $revegetationType = $generalActivity['revegetationType'];
        $vegetationDensity = $generalActivity['vegetationDensity'];
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
            'burn_status' => $burnStatus['id'],
            'vegetation_density' => $vegetationDensity['id'],
            'revegetation_type' => $revegetationType['id'],
            'total_area' => $generalActivity['totalArea'],
            'year' => $year,
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
