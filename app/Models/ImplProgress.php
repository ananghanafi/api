<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTrait;

class ImplProgress extends Model {
    use ModelTrait;
    
    protected $table = 'impl_progress';
    protected $fillable = [
        'impl_id',
        'activity_id',
        'activity_type',
        'periods',
        'physical_pct',
        'cost_pct',
        'cost',
        'remark',
    ];
    public $timestamps = false;
    
    protected $hidden = [
        'activity_type'
    ];
    
    private $rule_validate = [
        'implId' => 'required',
//        'activityType' => 'required',
        'periods' => 'required',
        'physicalPct' => 'required',
        'costPct' => 'required',
        'cost' => 'required',
        'remark' => 'required',
        'startDate' => 'required',
        'endDate' => 'required',
    ];
    
    public function add($params,$classModel) {
        $params = $this->camelToSnake($params->toArray());
       
        $find = [
            'impl_id' => $params['impl_id'],
            'activity_type' => $classModel,
            'periods' => $params['periods'],
        ]; 
        
        $data = [
            'impl_id' => $params['impl_id'],
            'activity_type' => $classModel,
            'periods' => $params['periods'],
            'physical_pct' => $params['physical_pct'],
            'cost_pct' => $params['cost_pct'],
            'cost' => $params['cost'],
            'remark' => $params['remark'],
        ];
        
        if($this->where('impl_id',$params['impl_id'])->where('activity_type',$classModel)->where('periods',$params['periods'])->first()){
            $new = $this->where('impl_id',$params['impl_id'])->where('activity_type',$classModel)->where('periods',$params['periods'])->update($data);
        }else{
            $new = $this->create($data);
        }
        
        return $new;
    }
    
    public function implProgress()
    {
        return $this->morphTo();
    }
}
