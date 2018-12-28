<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTrait;

class Organizations extends Model {
    use ModelTrait;
    
    protected $table = 'organizations';
    protected $fillable = [
        'code',
        'org_type',
        'short_name',
        'full_name',
        'address',
        'work_scope',
        'area_id',
    ];
    public $timestamps = true;
    
    private $rule_validate = [
        'code' => 'required',
        'org_type' => 'required',
        'shortName' => 'required',
        'fullName' => 'required',
        'address' => 'required',
        'work_scope' => 'required',
        'area_id' => 'required',
    ];
    
}
