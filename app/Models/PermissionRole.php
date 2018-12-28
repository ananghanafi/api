<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTrait;

class PermissionRole extends Model {
    use ModelTrait;
    
    protected $table = 'permission_role';
    protected $fillable = [
        'permission_id', 'role_id'
    ];
    public $timestamps = false;
}
