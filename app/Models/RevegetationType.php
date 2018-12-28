<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTrait;

class RevegetationType extends Model {
    use ModelTrait;
    
    protected $table = 'm_revegetation_type';
    protected $fillable = [
        'id',
        'desc',
    ];
    public $timestamps = false;
    
    private $rule_validate = [
        'desc' => 'required',
    ];
    
}
