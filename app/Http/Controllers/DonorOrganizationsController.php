<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DonorActivity;

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
        $this->validate($request, [
            'title' => '',
            'amount' => '',
        ]);
        $user = DonorActivity::create([
            'title' => $request->tittle,
            'amount' => $request->amount
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
