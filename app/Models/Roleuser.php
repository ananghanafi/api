<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTrait;

class Roleuser extends Model {
    use ModelTrait;
    
    protected $table = 'role_user';
    protected $fillable = [
        'user_id', 'role_id'
    ];
    public $timestamps = false;
    
    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }
}
