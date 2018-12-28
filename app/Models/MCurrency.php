<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTrait;

class MCurrency extends Model {
    use ModelTrait;
    
    protected $table = 'm_currency';
    protected $fillable = [
        'id',
        'code',
        'name',
        'symbol',
        'is_active',
    ];
    public $timestamps = false;
    
    private $rule_validate = [
        'code' => 'required',
        'name' => 'required',
        'symbol' => 'required',
    ];
    
}
