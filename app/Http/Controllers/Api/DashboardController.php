<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ControllerTrait;
use App\Models\CanalType;
use Validator;
use App\Models\CanalHoardingPlan;
use App\Models\CanalblockPlan;
use App\Models\ConstructionPlan;
use App\Models\RetentionBasinPlan;
use App\Models\RevegetationPlan;
use App\Models\RevitalizationPlan;
use DB;

class DashboardController extends Controller
{
    use ControllerTrait;
    
    public function anggaran()
    {
        $canalHoardingPlan = CanalHoardingPlan::select('cost','province_id', DB::raw('SUM(cost) as anggaran'))->groupBy('province_id')->get()->toArray();
        $canalblockPlan = CanalblockPlan::select('cost','province_id', DB::raw('SUM(cost) as anggaran'))->groupBy('province_id')->get()->toArray();
        $constructionPlan = ConstructionPlan::select('cost','province_id', DB::raw('SUM(cost) as anggaran'))->groupBy('province_id')->get()->toArray();
        $retentionBasinPlan = RetentionBasinPlan::select('cost','province_id', DB::raw('SUM(cost) as anggaran'))->groupBy('province_id')->get()->toArray();
        $revegetationPlan = RevegetationPlan::select('cost','province_id', DB::raw('SUM(cost) as anggaran'))->groupBy('province_id')->get()->toArray();
        $revitalizationPlan = RevitalizationPlan::select('cost','province_id', DB::raw('SUM(cost) as anggaran'))->groupBy('province_id')->get()->toArray();
        
        $collection = collect([$canalHoardingPlan, $canalblockPlan, $constructionPlan, $retentionBasinPlan, $revegetationPlan, $revitalizationPlan ]);
        $allCost = $collection->collapse();
        $prov = [];
        $total_anggaran = 0;
        foreach ($allCost->all() as $ang){
            $province_id = $ang['administrative_area']['province']->province_id;
            $prov[$province_id] = [
                'anggaran' => (isset($prov[$province_id]['anggaran']) ? $prov[$province_id]['anggaran'] : 0) + $ang['cost'],
                'province' => $ang['administrative_area']['province'],
            ];
            $total_anggaran += isset($prov[$province_id]['anggaran']) ? $prov[$province_id]['anggaran'] : 0;
        }
        
        $resp = [];
        foreach ($prov as $p) {
            $resp[] = [
                'anggaran' => $p['anggaran'],
                'persen' => $total_anggaran ? 100 * ($p['anggaran']/$total_anggaran ) : 0,
                'province' => $p['province']->long_name,
            ];
        }
        
        return $this->sendData($resp);
    }

    public function totalCost()
    {
        $wellPlan = DB::table('construction_plan')->sum('cost');
        $canalBlockPlan = DB::table('canal_block_plans')->sum('cost');
        $canalHoardingPlan = DB::table('canal_hoarding_plans')->sum('cost');
        $retentionBasinPlan = DB::table('retention_basin_plans')->sum('cost');
        $revegetationPlan = DB::table('revegetation_plans')->sum('cost');
        $revitalizationPlan = DB::table('revitalization_plans')->sum('cost');

        $total = collect([$wellPlan, $canalBlockPlan, $canalHoardingPlan, $retentionBasinPlan,
            $revegetationPlan, $revitalizationPlan])->sum();

        $resp = [ 'totalCost' => $total ];

        return $this->sendData($resp);
    }
    
    public function costByFundingSource()
    {
        $wellPlan = DB::table('construction_plan')
            ->select('funding_source', DB::raw('sum(cost) as cost'))
            ->groupBy('funding_source')->whereNotNull('cost')->get();

        $canalBlockPlan = DB::table('canal_block_plans')
            ->select('funding_source', DB::raw('sum(cost) as cost'))
            ->groupBy('funding_source')->whereNotNull('cost')->get();

        $canalHoardingPlan = DB::table('canal_hoarding_plans')
            ->select('funding_source', DB::raw('sum(cost) as cost'))
            ->groupBy('funding_source')->whereNotNull('cost')->get();

        $retentionBasinPlan = DB::table('retention_basin_plans')
            ->select('funding_source', DB::raw('sum(cost) as cost'))
            ->groupBy('funding_source')->whereNotNull('cost')->get();

        $revegetationPlan = DB::table('revegetation_plans')
            ->select('funding_source', DB::raw('sum(cost) as cost'))
            ->groupBy('funding_source')->whereNotNull('cost')->get();

        $revitalizationPlan = DB::table('revitalization_plans')
            ->select('funding_source', DB::raw('sum(cost) as cost'))
            ->groupBy('funding_source')->whereNotNull('cost')->get();

        $mFundingSource = DB::table('funding_sources')->get();

        // $canalBlockPlan = DB::table('canal_block_plans as a')
        //     ->select('b.id as funding_source_id', 'b.remark as funding_source', 
        //         DB::raw('sum(cost) as cost'))
        //     ->leftJoin('funding_sources as b', 'a.funding_source', '=', 'b.id')
        //     ->groupBy('a.funding_source')->whereNotNull('a.cost')->get();

        $collection = collect([$wellPlan, $canalBlockPlan, $canalHoardingPlan, $retentionBasinPlan,
            $revegetationPlan, $revitalizationPlan])->collapse();

        $totalFunding = $collection->groupBy('funding_source')->map(function ($item) {
                return $item->sum(function ($item) {
                    return $item->cost;
                });
        });

        // $total = [];
        $resp = [];

        foreach ($mFundingSource as $k => $v) {
            // $total[$v->remark] = $totalFunding[$v->id];
            $value = isset($totalFunding[$v->id]) ? $totalFunding[$v->id] : null;
            $resp[] = [ 'name' => $v->remark, 'value' => $value ];
        }
        // dd($resp);
        return json_encode($resp);
    }

    public function costByProvince()
    {
        $wellPlan = DB::table('construction_plan')
            ->select('province_id', DB::raw('sum(cost) as cost'))
            ->groupBy('province_id')->whereNotNull('cost')->get();

        $canalBlockPlan = DB::table('canal_block_plans')
            ->select('province_id', DB::raw('sum(cost) as cost'))
            ->groupBy('province_id')->whereNotNull('cost')->get();

        $canalHoardingPlan = DB::table('canal_hoarding_plans')
            ->select('province_id', DB::raw('sum(cost) as cost'))
            ->groupBy('province_id')->whereNotNull('cost')->get();

        $retentionBasinPlan = DB::table('retention_basin_plans')
            ->select('province_id', DB::raw('sum(cost) as cost'))
            ->groupBy('province_id')->whereNotNull('cost')->get();

        $revegetationPlan = DB::table('revegetation_plans')
            ->select('province_id', DB::raw('sum(cost) as cost'))
            ->groupBy('province_id')->whereNotNull('cost')->get();

        $revitalizationPlan = DB::table('revitalization_plans')
            ->select('province_id', DB::raw('sum(cost) as cost'))
            ->groupBy('province_id')->whereNotNull('cost')->get();

        $targetedProvinces = DB::table('provinces')->where('is_enabled',1)->get();

        $collection = collect([$wellPlan, $canalBlockPlan, $canalHoardingPlan, $retentionBasinPlan,
            $revegetationPlan, $revitalizationPlan])->collapse();

        $totalFunding = $collection->groupBy('province_id')->map(function ($item) {
            return $item->sum(function ($item) {
                return $item->cost;
            });
        });

        // $total = [];
        $resp = [];

        foreach ($targetedProvinces as $k => $v) {
            $value = isset($totalFunding[$v->province_id]) ? $totalFunding[$v->province_id] : null;
            // $total[$v->short_name] = $value;
            $resp[] = [ 'name' => $v->short_name, 'value' => $value ];
        }
        return json_encode($resp);
    }

    public function totalArea()
    {
        $revegetationPlan = DB::table('revegetation_plans')->sum('total_area');
        $r21Plan = DB::table('revitalization_plans')->sum('r2_1_ha');
        $r22Plan = DB::table('revitalization_plans')->sum('r2_2_ha');
        $r23Plan = DB::table('revitalization_plans')->sum('r2_3_ha');
        $revitalizationPlan = $r21Plan + $r22Plan + $r23Plan;

        $total = collect([$revegetationPlan, $revitalizationPlan])->sum();

        $resp = [ 'totalArea' => $total ];

        return $this->sendData($resp);
    }

    public function areaByProvince()
    {
        $revegetationPlan = DB::table('revegetation_plans')
            ->select('province_id', DB::raw('sum(total_area) as total_area'))
            ->groupBy('province_id')->get();

        $r21Plan = DB::table('revitalization_plans')
            ->select('province_id', DB::raw('sum(r2_1_ha) as total_area'))
            ->groupBy('province_id')->get();

        $r22Plan = DB::table('revitalization_plans')
            ->select('province_id', DB::raw('sum(r2_1_ha) as total_area'))
            ->groupBy('province_id')->get();

        $r23Plan = DB::table('revitalization_plans')
            ->select('province_id', DB::raw('sum(r2_3_ha) as total_area'))
            ->groupBy('province_id')->get();

        $targetedProvinces = DB::table('provinces')->where('is_enabled',1)->get();

        $collection = collect($revegetationPlan, $r21Plan, $r22Plan, $r23Plan);

        $totalArea = $collection->groupBy('province_id')->map(function ($item) {
            return $item->sum(function ($item) {
                return $item->total_area;
            });
        });

        $resp = [];

        foreach ($targetedProvinces as $k => $v) {
            $value = isset($totalArea[$v->province_id]) ? $totalArea[$v->province_id] : null;
            $resp[] = [ 'name' => $v->short_name, 'value' => $value ];
        }
        return json_encode($resp);
    }

    public function totalAction()
    {
        $wellPlan = DB::table('construction_plan')->count('id');
        $canalBlockPlan = DB::table('canal_block_plans')->count('id');
        $canalHoardingPlan = DB::table('canal_hoarding_plans')->count('id');
        $retentionBasinPlan = DB::table('retention_basin_plans')->count('id');

        $total = collect([$wellPlan, $canalBlockPlan, $canalHoardingPlan, $retentionBasinPlan])->sum();

        $resp = [ 'totalAction' => $total ];

        return $this->sendData($resp);
    }

    public function actionByProvince()
    {
        $wellPlan = DB::table('construction_plan')
            ->select('province_id', DB::raw('count(id) as action'))->groupBy('province_id')->get();

        $canalBlockPlan = DB::table('canal_block_plans')
            ->select('province_id', DB::raw('count(id) as action'))->groupBy('province_id')->get();

        $canalHoardingPlan = DB::table('canal_hoarding_plans')
            ->select('province_id', DB::raw('count(id) as action'))->groupBy('province_id')->get();

        $retentionBasinPlan = DB::table('retention_basin_plans')
            ->select('province_id', DB::raw('count(id) as action'))->groupBy('province_id')->get();

        $targetedProvinces = DB::table('provinces')->where('is_enabled',1)->get();

        $collection = collect([$wellPlan, $canalBlockPlan, $canalHoardingPlan, $retentionBasinPlan])->collapse();

        $totalAction = $collection->groupBy('province_id')->map(function ($item) {
            return $item->sum(function ($item) {
                return $item->action;
            });
        });

        $resp = [];

        foreach ($targetedProvinces as $k => $v) {
            $value = isset($totalAction[$v->province_id]) ? $totalAction[$v->province_id] : null;
            $resp[] = [ 'name' => $v->short_name, 'value' => $value ];
        }
        return json_encode($resp);
    }
}
