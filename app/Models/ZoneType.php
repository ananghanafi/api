<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTrait;

class ZoneType extends Model {
    use ModelTrait;
    
    protected $table = 'zone_type';
    protected $fillable = [
        'id',
        'type',
        'desc',
    ];
    public $timestamps = false;
    
    private $rule_validate = [
        'type' => 'required',
        'desc' => 'required',
    ];
    
}
