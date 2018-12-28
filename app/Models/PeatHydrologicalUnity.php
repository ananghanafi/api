<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTrait;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Grimzy\LaravelMysqlSpatial\Types\Polygon;
use Grimzy\LaravelMysqlSpatial\Types\LineString;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;

class PeatHydrologicalUnity extends Model {
    use SpatialTrait, ModelTrait;
    
    protected $table = 'phu';
    protected $fillable = [
        'code',
        'name',
        'area',
        'year',
    ];
    public $timestamps = true;
    
    protected $spatialFields = [
        'area'
    ];
    
    private $rule_validate = [
        'code' => 'required',
        'name' => 'required',
        'area' => 'required',
        'area.*.lat' => 'required',
        'area.*.lng' => 'required',
        'year' => 'required',
    ];
    
    public function add($params) {
        $data = [];
        foreach ($this->getFillable() as $field) {
            if(isset($params->{$field})){
                if($field == 'area'){
                    $linestring = [];
                    foreach ($params->area as $poin) {
                        $linestring[] = new Point($poin->lat, $poin->lng);
                    }
                    $area = new Polygon([new LineString($linestring)]);
                    $data[$field] = $area;
                }else{
                    $data[$field] = $params->{$field};
                }
            }
        }
        $new = $this->create($data);
        return $new;
    }
    
    public function ubah($params) {
        $data = [];
        foreach ($this->getFillable() as $field) {
            if($field == 'area'){
                $linestring = [];
                foreach ($params->area as $poin) {
                    $linestring[] = new Point($poin->lat, $poin->lng);
                }
                $area = new Polygon([new LineString($linestring)]);
                $data[$field] = $area;
            }else{
                $data[$field] = $params->{$field};
            }
        }
        $new = $this->whereId($params->id)->update($data);
      
        return $new;
    }
    
    public function area()
    {
        return $this->hasMany(\App\Models\PhuAdmAreas::class,'phu_id');
    }
}
