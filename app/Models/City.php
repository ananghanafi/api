<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTrait;

class City extends Model {
    use ModelTrait;
    
    protected $table = 'cities';
    protected $primaryKey = 'city_id';
    protected $fillable = [
        'province_id',
        'short_name',
        'long_name',
    ];
    public $timestamps = false;
    
    private $rule_validate = [
        'province_id' => 'required',
        'short_name' => 'required',
        'long_name' => 'required',
    ];
    
    
    public function admArea()
    {
        return $this->morphMany('App\Models\PhuAdmAreas', 'adm', 'adm_area_type', 'adm_area_id');
    }
    
}
