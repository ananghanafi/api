<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\ApilibUserTrait;

class Personal extends Model
{
    use Notifiable,ApilibUserTrait,ModelTrait;
    protected $table = 'personals';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'email',
        'jenis',
        'tanggal',
        'jmlanggota',
        'admin',
        'password',
        'api_token',
    ];
    public $timestamps = true;
     
    protected $hidden = [
        'password', 'remember_token','api_token'
    ];
    
    private $rule_validate = [
        'name' => 'required',
        'email' => 'required',
        'password' => 'required',

    ];
    // protected $appends = ['work_scope'];
    
    public function add($params) {
        $data = [];
        foreach ($this->getFillable() as $field) {
            if($field == 'password'){
                $data[$field] = bcrypt($params->{$field});
            }
            elseif($field == 'jenis'){
                $data[$field] = $params->{$field};
                if($params->{$field} == 1){
                    $data[$field] = "Lembaga";
                }elseif($params->{$field} == 2){
                    $data[$field] = "Instansi";
                }elseif($params->{$field} == 3){
                    $data[$field] = "Universitas";
                }elseif($params->{$field} == 4){
                    $data[$field] = "Organisasi";
                }elseif($params->{$field}== 5){
                    $data[$field] = "Institusi";
                }
               
            }elseif($field == 'admin'){
                if($params->{$field} == 1){
                    $data[$field] = "Provinsi";
                }elseif($params->{$field} == 2){
                    $data[$field] = "Kabupaten/Kota";
                }elseif($params->{$field} == 3){
                    $data[$field] = "Kecamatan";
                }elseif($params->{$field} == 4){
                    $data[$field] = "Kelurahan";
                }
                $data[$field] = $params->{$field};
            }
            else{
                $data[$field] = $params->{$field};
            }
        }
        $data['api_token'] = md5($params->email);
        // $data['isActive'] = 1;
        // $data['isDeleted'] = 0;
        $new = $this->create($data);
        return $new;
    }
    public function tampil(){
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
        $new = $this->show($data);
      
        return $new;
    }
    
    // public function getWorkScopeAttribute($value)
    // {
    //     $work_scope = [
    //         'kota_id' => 0,
    //         'provinsi_id' => 0,
    //     ];
    //     // $ret = $this->person;
    //     // if(isset($ret->organization)){
    //     //     foreach ($ret->organization as $org) {
    //     //         if($org->work_scope == 'provinsi'){
    //     //             $work_scope['provinsi_id'] = $org->area_id;
    //     //         }else if($org->work_scope == 'kota'){
    //     //             $work_scope['kota_id'] = $org->area_id;
    //     //         }
    //     //     };
    //     // }
        
    //     return $work_scope;
    // }
    
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

    
    // public function jenis()
    // {
    //     return $this->hasOne(\App\Models\Jenis::class);
    // }
    // public function admin()
    // {
    //     return $this->hasOne(\App\Models\Admin::class);
    // }
    // public function person()
    // {
    //     return $this->hasOne(\App\Models\Person::class);
    // }
}
