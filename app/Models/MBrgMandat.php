<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTrait;

class MBrgMandat extends Model {
    use ModelTrait;
    
    protected $table = 'm_brg_mandat';
    protected $fillable = [
        'id',
        'desc_id',
        'desc_en',
    ];
    public $timestamps = false;
    
    private $rule_validate = [
        'desc_id' => 'required',
    ];
    
}
