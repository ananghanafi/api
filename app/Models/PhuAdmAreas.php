<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTrait;

class PhuAdmAreas extends Model {
    use ModelTrait;
    
    protected $table = 'phu_adm_areas';
    protected $fillable = [
        'phu_id',
        'adm_area_type',
        'adm_area_id',
    ];
    public $timestamps = false;
    
    protected $hidden = [
        'activity_type'
    ];
    
    private $rule_validate = [
    ];
    
    public function admArea()
    {
        return $this->morphTo();
    }
    
    public function province()
    {
        return $this->belongsTo(Province::class, 'adm_area_id')
            ->where('adm_area_type','App\Models\Province');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'adm_area_id')
            ->where('adm_area_type','App\Models\City');
    }
}
