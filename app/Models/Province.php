<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTrait;

class Province extends Model {
    use ModelTrait;
    
    protected $table = 'provinces';
    protected $primaryKey = 'province_id';
    protected $fillable = [
        'short_name',
        'long_name',
        'is_enabled',
    ];
    public $timestamps = false;
    
    private $rule_validate = [
        'short_name' => 'required',
        'long_name' => 'required',
        'is_enabled' => 'in:0,1'
    ];
    
    public function admArea()
    {
        return $this->morphMany('App\Models\PhuAdmAreas', 'adm', 'adm_area_type', 'adm_area_id');
    }
    
}
