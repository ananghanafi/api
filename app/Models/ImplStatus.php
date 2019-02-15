<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTrait;

class Jenis extends Model {
    use ModelTrait;
    
    protected $table = 'jenis';
    protected $fillable = [
        'jenis_id',
        'jenis_en',
    ];
    public $timestamps = false;
    
    // private $rule_validate = [
    //     'status' => 'required',
    //     'remark' => 'required',
    // ];
    
}
