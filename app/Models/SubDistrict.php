<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTrait;

class SubDistrict extends Model {
    use ModelTrait;
    
    protected $table = 'sub_district';
    protected $fillable = [
        'city_id',
        'short_name',
        'long_name',
    ];
    public $timestamps = false;
    
    private $rule_validate = [
        'city_id' => 'required',
        'short_name' => 'required',
        'long_name' => 'required',
    ];
    
}
