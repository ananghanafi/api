<?php

namespace App\Traits;


use Illuminate\Support\Facades\Cache;
use Illuminate\Cache\TaggableStore;
use URL;
use App\Lib\Lib;
use App\Models\Config;
use Auth;
use Illuminate\Contracts\Support\Arrayable;
use App\Filters\CustomFilter;

trait ControllerTrait{
  
    protected $filter;
   
    public function __construct(CustomFilter $filter)
    {
        $this->filter = $filter;
    }
    
    private function customPaginate($model,$request,$filterable = ['id'],  $paginate = 15)
    {
        $this->filter->setFilterables($filterable);
        
        $model->filter($this->filter);
        $page = $request->page ? $request->page : 1;
        $total = $model->toBase()->getCountForPagination();
        $data = $model->forPage($page, $paginate)->get();
        
        $result = [];
        if(!empty($data)){
            foreach ($data as $key => $value) {
                $result[]  = [
                    'generalActivity' => $value,
                    'detailActivity' => null,
                    'status' => $value->status()->first(),
                ];
            }
        }
        
//        $itemsForCurrentPage = array_slice($result, $offSet, $paginate, true);  
        $result = new \Illuminate\Pagination\LengthAwarePaginator($result,$total, $paginate, $page);
        $result = $result->toArray();
        return $result;
    }
    
    private function paginasi($model,$request,$filterable = ['id'],  $paginate = 15)
    {
        $this->filter->setFilterables($filterable);
        return $model->filter($this->filter)->paginate();
    }
    
    private function customGet($model,$filterable = ['id'])
    {
        $this->filter->setFilterables($filterable);
        return $model->filter($this->filter)->get();
    }
    
    public function uploadFile($item, $media = 'document', $description = '', $category = ''){
        return $item->addMediaFromRequest('file')
                ->withCustomProperties(
                        [
                            'description' => $description,
                            'category' => $category
                        ]
                    )
                ->toMediaCollection($media);
    }
    
    public function sendData($data=[]){   
        $data = $this->encodeJson($data);
        return Lib::sendData($data);
    }
    
    public function sendError($message="error",$code=400){   
        return Lib::sendError($message,$code);
    }
    public function getExpiredCache(){
        return Lib::getExpiredCache();
    }
    
    public function clearCache($tagCache){
        if(Cache::getStore() instanceof TaggableStore) {
            Cache::tags($tagCache)->flush();
        }
    }
    
    public static function findFromCache($id,$model,$tagCache){
        $table_model = $model->getTable();
        $key = $table_model.$id;
        $expired = Lib::getExpiredCache();
        if(Cache::getStore() instanceof TaggableStore) {
            return Cache::tags($tagCache)->remember($key, $expired, function () use ($model,$id) {
                return $model->find($id);
            });
        }else{
            return $model->find($id);
        }
    }
    
    public function paginateFromCache($tagCache,$model,$key){
        $expired = Lib::getExpiredCache();
        if(Cache::getStore() instanceof TaggableStore) {
            $result = Cache::tags($tagCache)->remember(URL::full().'_paginate_'.$key, $expired, function () use ($model) {
                return $model->orderBy('created_at','DESC')->paginate(config('apilib.paginate'));
            });
        }else{   
            $result = $model->orderBy('created_at','DESC')->paginate(config('apilib.paginate'));
        }
        return $result;
    }
    
    public static function getFromCache($tagCache,$model,$key){
        $expired = Lib::getExpiredCache();
        if(Cache::getStore() instanceof TaggableStore) {
            $result = Cache::tags($tagCache)->remember('get_'.$key, $expired, function () use ($model) {
                return $model->get();
            });
        }else{   
            $result = $model->get();
        }
        return $result;
    }
    
    public static function firstFromCache($tagCache,$model,$key){
        $expired = Lib::getExpiredCache();
        if(Cache::getStore() instanceof TaggableStore) {
            $result = Cache::tags($tagCache)->remember('first_'.$key, $expired, function () use ($model) {
                return $model->first();
            });
        }else{   
            $result = $model->first();
        }
        return $result;
    }
    
    public function userCanAddRole(){
        $user = Auth::user();
        $roleallow = "";
        if($user->hasRole('opr-instansi')){
            $roleallow = (new Config)->getConfig('opr-instansi_allow');
        }
        if($user->hasRole('admin-instansi')){
            $roleallow = (new Config)->getConfig('admin-instansi_allow');
        }
        if($user->is_admin()){
            $roleallow = (new Config)->getConfig('administrator_allow');
        }
        return $roleallow;
    }
    
    public function roleToEnroledMoodle(){
        return explode(','(new Config)->getConfig('roleToEnroledMoodle'));
    }
    
    /**
     * Encode a value to camelCase JSON
     */
    public function encodeJson($value)
    {
        if ($value instanceof Arrayable) {
            return $this->encodeArrayable($value);
        } else if (is_array($value)) {
            return $this->encodeArray($value);
        } else if (is_object($value)) {
            return $this->encodeArray((array) $value);
        } else {
            return $value;
        }
    }
    /**
     * Encode a arrayable
     */
    public function encodeArrayable($arrayable)
    {
        $array = $arrayable->toArray();
        return $this->encodeJson($array);
    }
    /**
     * Encode an array
     */
    public function encodeArray($array)
    {
        $newArray = [];
        foreach ($array as $key => $val) {
            $newArray[\camel_case($key)] = $this->encodeJson($val);
        }
        return $newArray;
    }
    }
