<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTrait;

class Status extends Model {
    use ModelTrait;
    
    protected $table = 'status';
    protected $fillable = [
        'status',
        'alt_status',
    ];
    public $timestamps = false;
    
    private $rule_validate = [
        'status' => 'required',
        'alt_status' => 'required',
    ];
    
}
