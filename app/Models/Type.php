<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTrait;

class Type extends Model {
    use ModelTrait;
    
    protected $table = 'type';
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
