<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTrait;

class CanalBlockingType extends Model {
    use ModelTrait;
    
    protected $table = 'm_canal_blocking_types';
    protected $fillable = [
        'id',
        'desc',
    ];
    public $timestamps = false;
    
    private $rule_validate = [
        'desc' => 'required',
    ];
    
}
