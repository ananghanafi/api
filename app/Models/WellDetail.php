<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTrait;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;


class WellDetail extends Model {
    use ModelTrait, SpatialTrait;
    
    protected $table = 'well_details';
    protected $primaryKey = 'activity_id';
    protected $fillable = [
        'activity_id',
        'well_depth',
        'peat_depth',
        'well_debit',
        'well_pressure',
        'nearest_well',
        'coordinate',
        'utm_zone',
        'elevation',
        'road_access',
        'location_remark',
        'detail_sketch',
        'to_north',
        'to_south',
        'to_east',
        'to_west',
        'start_date',
        'end_date',
        'exec_team',
        'exec_team_category',
        'exec_team_remark',
    ];
    public $timestamps = true;
    protected $spatialFields = [
        'coordinate'
    ];
    private $rule_validate = [
        'detailActivity.wellDepth' => 'required',
        'detailActivity.peatDepth' => 'required',
        'detailActivity.wellDebit' => 'required',
        'detailActivity.wellPressure' => 'required',
        'detailActivity.nearestWell' => 'required',
        'detailActivity.coordinate' => 'required',
        'detailActivity.coordinate.lat' => 'required',
        'detailActivity.coordinate.lng' => 'required',
        'detailActivity.utmZone' => 'required',
        'detailActivity.elevation' => 'required',
        'detailActivity.roadAccess' => 'required',
        'detailActivity.locationRemark' => 'required',
        'detailActivity.detailSketch' => 'required',
        'detailActivity.toNorth' => 'required',
        'detailActivity.toSouth' => 'required',
        'detailActivity.toEast' => 'required',
        'detailActivity.toWest' => 'required',
        'detailActivity.startDate' => 'required',
        'detailActivity.endDate' => 'required',
        'detailActivity.execTeam' => 'required',
        'detailActivity.execTeamCategory' => 'required',
        'detailActivity.execTeamRemark' => 'required',
    ];
    
    public function getCoordinateAttribute($value)
    {
         return [
            //  'lat' => $value->getLat(),
            //  'lng' => $value->getLng(),
         ];  
    }
    
    public function add($params) {
        $params = $this->camelToSnake($params);
        $data = [];
        foreach ($this->getFillable() as $field) {
            if(isset($params[$field])){
                if($field == 'coordinate'){
                    $coordinate = $params['coordinate'];
                    $coordinate = new Point($coordinate['lat'],$coordinate['lng']);
                    $data[$field] = $coordinate;
                }else{
                    $data[$field] = $params[$field];
                }
            }
        }
        
        $new = $this->create($data);
   
        return $new;
    }
    
    public function ubah($params) {
        $params = $this->camelToSnake($params);
        $data = [];
        foreach ($this->getFillable() as $field) {
            if(isset($params[$field])){
                if($field == 'coordinate'){
                    $coordinate = $params['coordinate'];
                    $coordinate = null;//new Point($coordinate['lat'],$coordinate['lng']);
                    $data[$field] = $coordinate;
                }else{
                    $data[$field] = $params[$field];
                }
            }
        }
        try {
            $new = $this->whereId($params['id'])->update($data);
        } catch (\Exception $e) {
            throw $e;
        }
      
        return $new;
    }
    
}
