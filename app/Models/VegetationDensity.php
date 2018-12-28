<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTrait;

class VegetationDensity extends Model {
    use ModelTrait;
    
    protected $table = 'm_vegetation_density';
    protected $fillable = [
        'id',
        'density',
        'land_cover'
    ];
    public $timestamps = false;
    
    private $rule_validate = [
        'density' => 'required',
        'land_cover' => 'required',
    ];
    
}
