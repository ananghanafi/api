<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTrait;


class CanalHoardingDetail extends Model {
    use ModelTrait;
    
    protected $table = 'canal_hoarding_details';
    protected $primaryKey = 'activity_id';
    protected $fillable = [
        'activity_id',
        'utm_zone',
        'elevation',
        'road_access',
        'location_remark',
        'start_date',
        'end_date',
        'exec_team',
        'exec_team_category',
        'exec_team_remark',
    ];
    public $timestamps = true;
    
    private $rule_validate = [
        'detailActivity.utmZone' => 'required',
        'detailActivity.elevation' => 'required',
        'detailActivity.roadAccess' => 'required',
        'detailActivity.locationRemark' => 'required',
        'detailActivity.startDate' => 'required',
        'detailActivity.endDate' => 'required',
        'detailActivity.execTeam' => 'required',
        'detailActivity.execTeamCategory' => 'required',
        'detailActivity.execTeamRemark' => 'required',
    ];
    
    
}
