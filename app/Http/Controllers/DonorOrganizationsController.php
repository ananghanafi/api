<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DonorActivity;
use App\Models\Organisasi;

class DonorOrganizationsController extends Controller
{

    public function index() {
        $model = new DonorActivity;
        $da = $model->get();
        // return $da;
        return view('add-donor', ['da' => $da]);
    }
    public function store(Request $request)
    {     
        $model = new Organisasi;
        $this->validate($request, [
            'title' => '',
            'amount' => '',
            'upload' => 'required',
            'upload.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if($request->hasfile('upload'))
        {

           foreach($request->file('upload') as $image)
           {
               $name=$image->getClientOriginalName();
               $image->move(public_path().'/images/', $name);  
               $data[] = $name;  
           }
        }

        // $form= new Form();
        $model->filename=json_encode($data);
        
       
       $model->save();
       Organisasi::create([
            'country'=>$request->country,
            'name'=>$request->name,
            'upload'=>$request->upload,
            'key'=>$request->key,
            'focal'=>$request->focal,
        ]);
         return redirect('/home');
    }
    public function add(Request $request){
        $model = new DonoActivity;
        $amount = $request->amount;
        $title = $request->tittle;
        return $this->show($new->id);
        
        // return "con";
     }

}
