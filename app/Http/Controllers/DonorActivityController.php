<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DonorActivity;
use App\Models\DonorDash;
use DB;

class DonorActivityController extends Controller
{
    public function index() {
        $model = new DonorActivity;
        $da = $model->get();
        // return $da;
        return view('donor-activity', ['da' => $da]);
    }

    public function report() {
        $model = new DonorActivity;
        $da = $model->get();
        // return $da;
        return view('report-donor', ['da' => $da]);
    }
    public function add() {
        $model = new DonorActivity;
        $da = $model->get();
        // return $da;
        return view('add-donor', ['da' => $da]);
    }
    // public function anggaran(){

    //  return view('donor-activity', ['da'=>$peatlandRewetting]);
    // }
}
