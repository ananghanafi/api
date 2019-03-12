<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
 use App\Traits\ModelTrait;
use DB;

class Organisasi extends Model
{
    use HasMediaTrait, ModelTrait;
    protected $table = 'organisasi';
    protected $fillable = [
        'country',
        'name',
        'key',
        'focal',
    ];
    protected $timestimp= true;
    private $rule_validate = [
        'name' => 'required',
        'country' => 'required',
        'key' => 'required',
        'focal' => '',
    ];
}
