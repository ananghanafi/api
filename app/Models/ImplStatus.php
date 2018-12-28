<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTrait;

class ImplStatus extends Model {
    use ModelTrait;
    
    protected $table = 'm_impl_statuses';
    protected $fillable = [
        'status',
        'remark',
    ];
    public $timestamps = false;
    
    private $rule_validate = [
        'status' => 'required',
        'remark' => 'required',
    ];
    
}
