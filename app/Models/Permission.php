<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ApilibPermissionTrait;
use App\Traits\ModelTrait;

class Permission extends Model {

    use ApilibPermissionTrait,ModelTrait;
    
    protected $table = 'permissions';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'name', 'display_name', 'description'
    ];

}
