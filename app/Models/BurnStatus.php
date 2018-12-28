<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTrait;

class BurnStatus extends Model {
    use ModelTrait;
    
    protected $table = 'm_burn_status';
    protected $fillable = [
        'id',
        'desc',
    ];
    public $timestamps = false;
    
    private $rule_validate = [
        'desc' => 'required',
    ];
    
}
