<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTrait;

class Admin extends Model {
    use ModelTrait;
    
    protected $table = 'admin';
    protected $fillable = [
        'id',
        'admin_id',
        'admin_en',
    ];
    public $timestamps = false;
    
    private $rule_validate = [
        'admin_id' => 'required',
    ];
    
}
