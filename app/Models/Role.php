<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ApilibRoleTrait;
use App\Traits\ModelTrait;

class Role extends Model {

    use ApilibRoleTrait,ModelTrait;
    
    public $table = 'roles';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'name', 'display_name', 'descriptions'
    ];

}
