<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTrait;

class Upload extends Model {
    use ModelTrait;
    
    protected $table = 'uploads';
    protected $primaryKey = 'id';
    protected $fillable = [
        'origin_filename',
        'filename',
        'ext',
        'path',
    ];
    public $timestamps = true;
    
    private $rule_validate = [
        'file' => 'required',
    ];
    
}
