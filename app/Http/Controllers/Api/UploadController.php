<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ControllerTrait;
use App\Models\Upload;
use Validator;
use File;
use Auth;
use Carbon\Carbon;
use Storage;

class UploadController extends Controller
{
    use ControllerTrait;
    
    public function store(Request $request) {
        $model = new Upload;
        $validator = Validator::make($request->all(), $model->getRule());
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->toArray());
        }
        
        $user = Auth::user();
        $file = $request->file('file');
        $content = File::get($file);   
        $originFilename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
       
        
        $folder = Carbon::now()->format('Y/m/d');
        $destinationPath = "uploads/$folder";
        $fileName = $user->id.'_'.time() . '.' . $extension;
        Storage::makeDirectory($destinationPath);

        $upload_success = Storage::put($destinationPath . '/' . $fileName, $content);
        
        if ($upload_success) {
            $data = new \stdClass;
            $data->origin_filename = $originFilename;
            $data->filename = $fileName;
            $data->ext = $extension;
            $data->path = $folder;
            $new = $model->add($data);
            
            return $this->SendData($new);
        }
        return $this->sendError("Gagal Upload");

    }
    
    
}
