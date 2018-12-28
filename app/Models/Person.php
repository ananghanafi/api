<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTrait;

class Person extends Model {
    use ModelTrait;
    
    protected $table = 'person';
    protected $fillable = [
        'full_name',
        'title_prefix',
        'title_suffix',
        'email',
        'photo',
        'gender',
        'religion',
        'birth_place',
        'birth_date',
        'job_title',
        'is_deleted',
        'user_id',
    ];
    public $timestamps = true;
    
    private $rule_validate = [
        'fullName' => 'required',
        'email' => 'required|email',
        'birthDate' => 'date_format:Y-m-d',
        'gender' => 'required|in:L,P'
    ];
    
    public function organization()
    {
        return $this->belongsToMany(\App\Models\Organizations::class,'person_organization','person_id','organization_id');
    }
}
