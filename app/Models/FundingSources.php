<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTrait;

class FundingSources extends Model {
    use ModelTrait;
    
    protected $table = 'funding_sources';
    protected $fillable = [
        'type',
        'year',
        'remark'
    ];
    public $timestamps = true;
    
    private $rule_validate = [
        'type' => 'required',
        'year' => 'required',
        'remark' => 'required',
    ];
    
}
