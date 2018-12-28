<?php
namespace App\Traits;
use Kyslik\LaravelFilterable\Filterable;

trait ModelTrait{

    use Filterable;


    public function updateStatus($params) {

        $data = [
            'status' => $params->status,
        ];

        $new = $this->whereId($params->id)->update($data);

        return $new;
    }

    public function getFiles($withPath = false)
    {
        $files = array();
        if(count($this->getMedia('document'))){
            foreach ($this->getMedia('document') as $media) {
                $file = [
                    'file_name' => $media->file_name,
                    'file_type' => $media->mime_type,
                    'url' => $media->getFullUrl(),
                    'size' => $media->size,
                    'description' => $media->getCustomProperty('description'),
                ];
                if($withPath) $file['path']=$media->getPath();
                $files['document'][] = $file;
            }
        }else{
            $files['document']=[];
        }

        if(count($this->getMedia('galery'))){
            foreach ($this->getMedia('galery') as $media) {
                $file = [
                    'name' => $media->name,
                    'url' => $media->getFullUrl(),
                    'size' => $media->size,
                    'description' => $media->getCustomProperty('description'),
                    'category' => $media->getCustomProperty('category')
                ];
                if($withPath) $file['path']=$media->getPath();
                $files['galery'][] = $file;
            }
        }else{
            $files['galery']=[];
        }

        foreach (config('app.image-media-collection') as $collection) {
            if(count($this->getMedia($collection))){
                $media = $this->getFirstMedia($collection) ;
                $file = [
                    'name' => $media->name,
                    'url' => $media->getFullUrl(),
                    'size' => $media->size,
                ];
                if($withPath) $file['path'] = $media->getPath();
                $files[$collection][] = $file;

            }else{
                $files[$collection]=[];
            }
        }

        return $files;
    }


    public function paginasi($limit = 10){
        return $this->where('is_deleted',0)->paginate($limit);
    }

    public function getRule(){
        return $this->rule_validate;
    }

    public function findNoDelete($id) {
        $key = $this->getKey() ? $this->getKey() : 'id';
        return $this->where($key,$id)->where('is_deleted',0)->first();
    }

    public function add($params) {
        $params = $this->camelToSnake($params->toArray());
        $data = [];
        foreach ($this->getFillable() as $field) {
            if(array_key_exists($field, $params)){
                $data[$field] = $params[$field];
            }
        }
        $new = $this->create($data);
        return $new;
    }


    public function ubah($params,$id) {
        $params = $this->camelToSnake($params->toArray());
        $data = [];
        foreach ($this->getFillable() as $field) {
            if(array_key_exists($field, $params)){
                $data[$field] = $params[$field];
            }
        }
        $new = $this->whereId($id)->update($data);

        return $new;
    }

    public function patchUbah($params,$id) {

        $params = $this->camelToSnake($params->toArray());
        $data = [];
        foreach ($this->getFillable() as $field) {
            if(array_key_exists($field, $params)){
                $data[$field] = $params[$field];
            }
        }
        $new = $this->where($this->getKeyName(),$id)->update($data);

        return $new;
    }
    
    public function addOrUbah($params,$id) {

        $params = $this->camelToSnake($params->toArray());
        $data = [];
        foreach ($this->getFillable() as $field) {
            if(array_key_exists($field, $params)){
                $data[$field] = $params[$field];
            }
        }
        $new = $this->updateOrCreate([$this->getKeyName()=>$id],$data);

        return $new;
    }

    public function camelToSnake($paramsAll){
        $params = [];
        foreach ($paramsAll as $key => $value) {
            $params[strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $key))] = $value;
        }
        return $params;
    }



//    public function save(array $options = [])
//    {   //both inserts and updates
//        if(Cache::getStore() instanceof TaggableStore) {
//            Cache::tags($this->table)->flush();
//        }
//        return parent::save($options);
//    }
//    public function delete(array $options = [])
//    {   //soft or hard
//        parent::delete($options);
//        if(Cache::getStore() instanceof TaggableStore) {
//            Cache::tags($this->table)->flush();
//        }
//    }
//    public function restore()
//    {   //soft delete undo's
//        parent::restore();
//        if(Cache::getStore() instanceof TaggableStore) {
//            Cache::tags($this->table)->flush();
//        }
//    }

}

