<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\ApilibUserTrait;
use App\Traits\ModelTrait;

class User extends Authenticatable
{
    use Notifiable,ApilibUserTrait,ModelTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','api_token','isActive','isDeleted'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','api_token'
    ];
    
    private $rule_validate = [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required',

    ];
    protected $appends = ['work_scope'];
    
    public function getWorkScopeAttribute($value)
    {
        $work_scope = [
            'kota_id' => 0,
            'provinsi_id' => 0,
        ];
        $ret = $this->person;
        if(isset($ret->organization)){
            foreach ($ret->organization as $org) {
                if($org->work_scope == 'provinsi'){
                    $work_scope['provinsi_id'] = $org->area_id;
                }else if($org->work_scope == 'kota'){
                    $work_scope['kota_id'] = $org->area_id;
                }
            };
        }
        
        return $work_scope;
    }
    
    public function add($params) {
        $data = [];
        foreach ($this->getFillable() as $field) {
            if($field == 'password'){
                $data[$field] = bcrypt($params->{$field});
            }else{
                $data[$field] = $params->{$field};
            }
        }
        $data['api_token'] = md5($params->email);
        $data['isActive'] = 1;
        $data['isDeleted'] = 0;
        $new = $this->create($data);
        return $new;
    }
    
    
    public function ubah($params,$id) {
        $data = [];
        foreach ($this->getFillable() as $field) {
            if(isset($params->{$field})){
                if($field == 'password'){
                    $data[$field] = bcrypt($params->{$field});
                }else{
                    $data[$field] = $params->{$field};
                }
            }
            
        }
        $new = $this->whereId($id)->update($data);
      
        return $new;
    }
    
    public function person()
    {
        return $this->hasOne(\App\Models\Person::class);
    }
}
