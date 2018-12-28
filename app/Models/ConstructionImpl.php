<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTrait;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Grimzy\LaravelMysqlSpatial\Types\Polygon;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use DB;

class ConstructionImpl extends Model  implements HasMedia {
    use HasMediaTrait, ModelTrait, SpatialTrait;
    
    protected $table = 'construction_impl';
    protected $fillable = [
        'plan_id',
        'name',
        'code',
        'type',
        'unit',
        'affected_area',
        'zone_type',
        'cost',
        'funding_source',
        'remark',
        'province_id',
        'city_id',
        'sub_district_id',
        'village',
        'peat_hydrological_unity',
        'coordinate',
        'status',
        'year',
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
        'province_id', 'city_id','sub_district_id','village','status', 'media', 'implProgress'
    ];
    private $rule_validate = [
        'generalActivity' => 'required',
        'generalActivity.name' => 'required',
        'generalActivity.code' => 'required',
        'generalActivity.type' => 'required',
        'generalActivity.type.id' => 'required|in:1',
        'generalActivity.unit' => 'required',
        'generalActivity.affectedArea' => 'required',
        'generalActivity.zoneType' => 'required',
        'generalActivity.zoneType.id' => 'required',
        'generalActivity.cost' => 'required',
        'generalActivity.fundingSource' => 'required',
        'generalActivity.fundingSource.id' => 'required',
        'generalActivity.remark' => 'required',
        'generalActivity.administrativeArea' => 'required',
        'generalActivity.administrativeArea.province' => 'required',
        'generalActivity.administrativeArea.province.id' => 'required',
        'generalActivity.administrativeArea.city' => 'required',
        'generalActivity.administrativeArea.city.id' => 'required',
        'generalActivity.administrativeArea.subDistrict' => 'required',
        'generalActivity.administrativeArea.subDistrict.id' => 'required',
        'generalActivity.administrativeArea.village' => 'required',
        'generalActivity.peatHydrologicalUnity' => 'required',
        'generalActivity.peatHydrologicalUnity.id' => 'required',
        'generalActivity.coordinate' => 'required',
        'generalActivity.coordinate.lat' => 'required',
        'generalActivity.coordinate.lng' => 'required',
        'generalActivity.year' => 'required',
        'generalActivity.uprgText' => 'required',
        'generalActivity.uprgSlug' => 'required',
        'generalActivity.uprgId' => 'required',
        'generalActivity.lat' => 'required',
        'generalActivity.lng' => 'required',
    ];
    
    public function implProgress()
    {
        return $this->morphMany('App\Models\ImplProgress', 'activity', 'activity_type', 'impl_id');
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
    
    public function WellDetail()
    {
        return $this->belongsTo(\App\Models\WellDetail::class,'id');
    }
    
    public function type()
    {
        return $this->belongsTo(\App\Models\Type::class,'type');
    }
    
    public function zoneType()
    {
        return $this->belongsTo(\App\Models\ZoneType::class,'zone_type');
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
    
    public function peatHydrologicalUnity()
    {
        return $this->belongsTo(\App\Models\PeatHydrologicalUnity::class,'peat_hydrological_unity');
    }
    
    public function fundingSource()
    {
        return $this->belongsTo(\App\Models\FundingSources::class,'funding_source');
    }
    
    public function getCoordinateAttribute($value)
    {
//         return [
//             'lat' => $value->getLat(),
//             'lng' => $value->getLng(),
//         ];  
         return [
             'lat' => null,
             'lng' => null,
         ];  
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
        
        $coordinate = $plan->coordinate;
        $coordinate = new Point($coordinate['lat'],$coordinate['lng']);	
        $year = date("Y");
        
        $data = [
            'plan_id' => $plan->id,
            'name' => $plan->name,
            'code' => $plan->code,
            'type' => $plan->type,
            'unit' => $plan->unit,
            'affected_area' => $plan->affected_area,
            'zone_type' => $plan->zone_type,
            'cost' => $plan->cost,
            'funding_source' => $plan->funding_source,
            'remark' => $plan->remark,
            'province_id' => $plan->province_id,
            'city_id' => $plan->city_id,
            'sub_district_id' => $plan->sub_district_id,
            'village' => $plan->village,
            'peat_hydrological_unity' => $plan->peat_hydrological_unity,
            'coordinate' => $coordinate,
            'status' => 1,
            'year' => $year,
            'uprg_text' => $plan->uprg_text,
            'uprg_slug' => $plan->uprg_slug,
            'uprg_id' => $plan->uprg_id,
            'lat' => $plan->lat,
            'lng' => $plan->lng,
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
    
    public function ubah($params,$modelDetail) {
        $generalActivity = $params->generalActivity;
        $type = $generalActivity['type'];
        $zoneType = $generalActivity['zoneType'];
        $fundingSource = $generalActivity['fundingSource'];
        
        $administrativeArea = $generalActivity['administrativeArea'];
        $province = $administrativeArea['province'];
        $city = $administrativeArea['city'];
        $subDistrict = $administrativeArea['subDistrict'];
        
        $peatHydrologicalUnity = $generalActivity['peatHydrologicalUnity'];
        
//        $coordinate = $generalActivity['coordinate'];
//        $coordinate = new Point($coordinate['lat'],$coordinate['lng']);	
        
//        $status = $generalActivity['status'];
         
        $data = [
            'name' => $generalActivity['name'],
            'code' => $generalActivity['code'],
//            'type' => $type['id'],
            'unit' => $generalActivity['unit'],
            'affected_area' => $generalActivity['affectedArea'],
            'zone_type' => $zoneType['id'],
            'cost' => $generalActivity['cost'],
            'funding_source' => $fundingSource['id'],
            'remark' => $generalActivity['remark'],
            'province_id' => $province['provinceId'],
            'city_id' => $city['cityId'],
            'sub_district_id' => $subDistrict['id'],
            'village' => $administrativeArea['village'],
            'peat_hydrological_unity' => $peatHydrologicalUnity['id'],
            'year' => $generalActivity['year'],
            'uprg_text' => $generalActivity['uprgText'],
            'uprg_slug' => $generalActivity['uprgSlug'],
            'uprg_id' => $generalActivity['uprgId'],
            'lat' => $generalActivity['lat'],
            'lng' => $generalActivity['lng'],
//            'coordinate' => $coordinate,
        ];
       
        $dataDetail = $params->detailActivity;
        DB::beginTransaction();
        
        try {
            $new = $this->whereId($params->id)->update($data);
            
            $paramDetil = $dataDetail; 
            $dataDetail = $modelDetail->whereActivityId($params->id)->first();
            if($dataDetail){
                $paramDetil['id'] = $dataDetail->id;
                $new_detail = $modelDetail->ubah($paramDetil);
            }else{
                $paramDetil['activity_id'] = $params->id;
                $new_detail = $modelDetail->add($paramDetil);
            }
            

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
