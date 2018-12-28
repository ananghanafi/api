<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTrait;

class MDonorActivityStatuses extends Model {
    use ModelTrait;
    
    protected $table = 'm_donor_activity_statuses';
    protected $fillable = [
        'status',
        'remark',
    ];
    public $timestamps = false;
    
    private $rule_validate = [
        'status' => 'required',
    ];
    
}
