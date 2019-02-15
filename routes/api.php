<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('login', ['uses' => 'Api\LoginController@login']);

Route::group(['middleware' => ['auth:api','permission']], function () {

    Route::get('mdonoractivitystatuseses', ['as' => 'permission.donoractivitystatuses.all', 'uses' => 'Api\MDonorActivityStatusesController@all']);
    Route::get('mbrgmandat', ['as' => 'permission.brgmandat.all', 'uses' => 'Api\MBrgMandatController@all']);
    Route::get('mcurrency', ['as' => 'permission.mcurrency.all', 'uses' => 'Api\MCurrencyController@all']);
    
    Route::get('donoractivities', ['as' => 'permission.donoractivities.index', 'uses' => 'Api\DonorActivityController@index']);
    Route::post('donoractivities', ['as' => 'permission.donoractivities.store', 'uses' => 'Api\DonorActivityController@store']);
    Route::get('donoractivities/{id}', ['as' => 'permission.donoractivities.show', 'uses' => 'Api\DonorActivityController@show']);
    Route::put('donoractivities/{id}', ['as' => 'permission.donoractivities.update', 'uses' => 'Api\DonorActivityController@update']);
//    Route::delete('donoractivities/{id}', ['as' => 'permission.donoractivities.delete', 'uses' => 'Api\DonorActivityController@delete']);
    Route::put('donoractivities/{id}/status', ['as' => 'permission.donoractivities.updatestatus', 'uses' => 'Api\DonorActivityController@updateStatus']);

    Route::get('/dashboard/plan-anggaran', ['as' => 'permission.dashboardplan.anggaran', 'uses' => 'Api\DashboardController@anggaran']);
    Route::get('/dashboard/total-cost-plan', ['as' => 'permission.dashboardplan.totalcost', 'uses' => 'Api\DashboardController@totalCost']);
    Route::get('/dashboard/cost-by-funding-source-plan', ['as' => 'permission.dashboardplan.costbyfundingsource', 'uses' => 'Api\DashboardController@costByFundingSource']);
    Route::get('/dashboard/cost-by-province-plan', ['as' => 'permission.dashboardplan.costbyprovince', 'uses' => 'Api\DashboardController@costByProvince']);
    Route::get('/dashboard/total-area-plan', ['as' => 'permission.dashboardplan.totalarea', 'uses' => 'Api\DashboardController@totalArea']);
    Route::get('/dashboard/area-by-province-plan', ['as' => 'permission.dashboardplan.areabyprovince', 'uses' => 'Api\DashboardController@areaByProvince']);
    Route::get('/dashboard/total-action-plan', ['as' => 'permission.dashboardplan.totalaction', 'uses' => 'Api\DashboardController@totalAction']);
    Route::get('/dashboard/action-by-province-plan', ['as' => 'permission.dashboardplan.actionbyprovince', 'uses' => 'Api\DashboardController@actionByProvince']);

    Route::get('revitalizationplan', ['as' => 'permission.revitalizationplan.index', 'uses' => 'Api\RevitalizationPlanController@index']);
    Route::post('revitalizationplan', ['as' => 'permission.revitalizationplan.store', 'uses' => 'Api\RevitalizationPlanController@store']);
    Route::get('revitalizationplan/{id}', ['as' => 'permission.revitalizationplan.show', 'uses' => 'Api\RevitalizationPlanController@show']);
    Route::put('revitalizationplan/{id}', ['as' => 'permission.revitalizationplan.update', 'uses' => 'Api\RevitalizationPlanController@update']);
    Route::patch('revitalizationplan/{id}', ['as' => 'permission.revitalizationplan.updatepatch', 'uses' => 'Api\RevitalizationPlanController@updatePatch']);
    Route::put('revitalizationplan/{id}/status', ['as' => 'permission.revitalizationplan.updatestatus', 'uses' => 'Api\RevitalizationPlanController@updateStatus']);
    Route::patch('revitalizationplan/{id}/cost', ['as' => 'permission.revitalizationplan.updatecost', 'uses' => 'Api\RevitalizationPlanController@updateAnggaran']);
    Route::delete('revitalizationplan/{id}', ['as' => 'permission.revitalizationplan.delete', 'uses' => 'Api\RevitalizationPlanController@delete']);
    Route::put('revitalizationplan/{id}/document', ['as' => 'permission.revitalizationplan.document', 'uses' => 'Api\RevitalizationPlanController@document']);
    Route::put('revitalizationplan/{id}/image', ['as' => 'permission.revitalizationplan.image', 'uses' => 'Api\RevitalizationPlanController@image']);

    Route::get('revitalizationimpl', ['as' => 'permission.revitalizationimpl.index', 'uses' => 'Api\RevitalizationImplController@index']);
//    Route::post('revitalizationimpl', ['as' => 'permission.revitalizationimpl.store', 'uses' => 'Api\RevitalizationImplController@store']);
    Route::get('revitalizationimpl/{id}', ['as' => 'permission.revitalizationimpl.show', 'uses' => 'Api\RevitalizationImplController@show']);
    Route::put('revitalizationimpl/{id}', ['as' => 'permission.revitalizationimpl.update', 'uses' => 'Api\RevitalizationImplController@update']);
    Route::patch('revitalizationimpl/{id}', ['as' => 'permission.revitalizationimpl.updatepatch', 'uses' => 'Api\RevitalizationImplController@updatePatch']);
    Route::put('revitalizationimpl/{id}/status', ['as' => 'permission.revitalizationimpl.updatestatus', 'uses' => 'Api\RevitalizationImplController@updateStatus']);
    Route::delete('revitalizationimpl/{id}', ['as' => 'permission.revitalizationimpl.delete', 'uses' => 'Api\RevitalizationImplController@delete']);
    Route::put('revitalizationimpl/{id}/document', ['as' => 'permission.revitalizationimpl.document', 'uses' => 'Api\RevitalizationImplController@document']);
    Route::put('revitalizationimpl/{id}/image', ['as' => 'permission.revitalizationimpl.image', 'uses' => 'Api\RevitalizationImplController@image']);
    Route::put('revitalizationimpl/{id}/galery', ['as' => 'permission.revitalizationimpl.galery', 'uses' => 'Api\RevitalizationImplController@galery']);
    Route::post('revitalizationimpl/{id}/document', ['as' => 'permission.revitalizationimpl.document', 'uses' => 'Api\RevitalizationImplController@document']);
    Route::post('revitalizationimpl/{id}/image', ['as' => 'permission.revitalizationimpl.image', 'uses' => 'Api\RevitalizationImplController@image']);
    Route::post('revitalizationimpl/{id}/galery', ['as' => 'permission.revitalizationimpl.galery', 'uses' => 'Api\RevitalizationImplController@galery']);
    Route::post('revitalizationimpl/{id}/implprogress', ['as' => 'permission.revitalizationimpl.implprogress', 'uses' => 'Api\RevitalizationImplController@implProgress']);


    Route::get('retentionbasinplan', ['as' => 'permission.retentionbasinplan.index', 'uses' => 'Api\RetentionBasinPlanController@index']);
    Route::post('retentionbasinplan', ['as' => 'permission.retentionbasinplan.store', 'uses' => 'Api\RetentionBasinPlanController@store']);
    Route::get('retentionbasinplan/{id}', ['as' => 'permission.retentionbasinplan.show', 'uses' => 'Api\RetentionBasinPlanController@show']);
    Route::put('retentionbasinplan/{id}', ['as' => 'permission.retentionbasinplan.update', 'uses' => 'Api\RetentionBasinPlanController@update']);
    Route::patch('retentionbasinplan/{id}', ['as' => 'permission.retentionbasinplan.updatepatch', 'uses' => 'Api\RetentionBasinPlanController@updatePatch']);
    Route::put('retentionbasinplan/{id}/status', ['as' => 'permission.retentionbasinplan.updatestatus', 'uses' => 'Api\RetentionBasinPlanController@updateStatus']);
    Route::patch('retentionbasinplan/{id}/cost', ['as' => 'permission.retentionbasinplan.updatecost', 'uses' => 'Api\RetentionBasinPlanController@updateAnggaran']);
    Route::delete('retentionbasinplan/{id}', ['as' => 'permission.retentionbasinplan.delete', 'uses' => 'Api\RetentionBasinPlanController@delete']);
    Route::put('retentionbasinplan/{id}/document', ['as' => 'permission.retentionbasinplan.document', 'uses' => 'Api\RetentionBasinPlanController@document']);
    Route::put('retentionbasinplan/{id}/image', ['as' => 'permission.retentionbasinplan.image', 'uses' => 'Api\RetentionBasinPlanController@image']);

    Route::get('retentionbasinimpl', ['as' => 'permission.retentionbasinimpl.index', 'uses' => 'Api\RetentionBasinImplController@index']);
//    Route::post('retentionbasinimpl', ['as' => 'permission.retentionbasinimpl.store', 'uses' => 'Api\RetentionBasinImplController@store']);
    Route::get('retentionbasinimpl/{id}', ['as' => 'permission.retentionbasinimpl.show', 'uses' => 'Api\RetentionBasinImplController@show']);
    Route::put('retentionbasinimpl/{id}', ['as' => 'permission.retentionbasinimpl.update', 'uses' => 'Api\RetentionBasinImplController@update']);
    Route::patch('retentionbasinimpl/{id}', ['as' => 'permission.retentionbasinimpl.updatepatch', 'uses' => 'Api\RetentionBasinImplController@updatePatch']);
    Route::put('retentionbasinimpl/{id}/status', ['as' => 'permission.retentionbasinimpl.updatestatus', 'uses' => 'Api\RetentionBasinImplController@updateStatus']);
    Route::delete('retentionbasinimpl/{id}', ['as' => 'permission.retentionbasinimpl.delete', 'uses' => 'Api\RetentionBasinImplController@delete']);
    Route::put('retentionbasinimpl/{id}/document', ['as' => 'permission.retentionbasinimpl.document', 'uses' => 'Api\RetentionBasinImplController@document']);
    Route::put('retentionbasinimpl/{id}/image', ['as' => 'permission.retentionbasinimpl.image', 'uses' => 'Api\RetentionBasinImplController@image']);
    Route::put('retentionbasinimpl/{id}/galery', ['as' => 'permission.retentionbasinimpl.galery', 'uses' => 'Api\RetentionBasinImplController@galery']);
    Route::post('retentionbasinimpl/{id}/document', ['as' => 'permission.retentionbasinimpl.document', 'uses' => 'Api\RetentionBasinImplController@document']);
    Route::post('retentionbasinimpl/{id}/image', ['as' => 'permission.retentionbasinimpl.image', 'uses' => 'Api\RetentionBasinImplController@image']);
    Route::post('retentionbasinimpl/{id}/galery', ['as' => 'permission.retentionbasinimpl.galery', 'uses' => 'Api\RetentionBasinImplController@galery']);
    Route::post('retentionbasinimpl/{id}/implprogress', ['as' => 'permission.retentionbasinimpl.implprogress', 'uses' => 'Api\RetentionBasinImplController@implProgress']);

    Route::get('revegetationplan', ['as' => 'permission.revegetationplan.index', 'uses' => 'Api\RevegetationPlanController@index']);
    Route::post('revegetationplan', ['as' => 'permission.revegetationplan.store', 'uses' => 'Api\RevegetationPlanController@store']);
    Route::get('revegetationplan/{id}', ['as' => 'permission.revegetationplan.show', 'uses' => 'Api\RevegetationPlanController@show']);
    Route::put('revegetationplan/{id}', ['as' => 'permission.revegetationplan.update', 'uses' => 'Api\RevegetationPlanController@update']);
    Route::patch('revegetationplan/{id}', ['as' => 'permission.revegetationplan.updatepatch', 'uses' => 'Api\RevegetationPlanController@updatePatch']);
    Route::put('revegetationplan/{id}/status', ['as' => 'permission.revegetationplan.updatestatus', 'uses' => 'Api\RevegetationPlanController@updateStatus']);
    Route::patch('revegetationplan/{id}/cost', ['as' => 'permission.revegetationplan.updatecost', 'uses' => 'Api\RevegetationPlanController@updateAnggaran']);
    Route::delete('revegetationplan/{id}', ['as' => 'permission.revegetationplan.delete', 'uses' => 'Api\RevegetationPlanController@delete']);
    Route::put('revegetationplan/{id}/document', ['as' => 'permission.revegetationplan.document', 'uses' => 'Api\RevegetationPlanController@document']);
    Route::put('revegetationplan/{id}/image', ['as' => 'permission.revegetationplan.image', 'uses' => 'Api\RevegetationPlanController@image']);

    Route::get('revegetationimpl', ['as' => 'permission.revegetationimpl.index', 'uses' => 'Api\RevegetationImplController@index']);
//    Route::post('revegetationimpl', ['as' => 'permission.revegetationimpl.store', 'uses' => 'Api\RevegetationImplController@store']);
    Route::get('revegetationimpl/{id}', ['as' => 'permission.revegetationimpl.show', 'uses' => 'Api\RevegetationImplController@show']);
    Route::put('revegetationimpl/{id}', ['as' => 'permission.revegetationimpl.update', 'uses' => 'Api\RevegetationImplController@update']);
    Route::patch('revegetationimpl/{id}', ['as' => 'permission.revegetationimpl.updatepatch', 'uses' => 'Api\RevegetationImplController@updatePatch']);
    Route::put('revegetationimpl/{id}/status', ['as' => 'permission.revegetationimpl.updatestatus', 'uses' => 'Api\RevegetationImplController@updateStatus']);
    Route::delete('revegetationimpl/{id}', ['as' => 'permission.revegetationimpl.delete', 'uses' => 'Api\RevegetationImplController@delete']);
    Route::put('revegetationimpl/{id}/document', ['as' => 'permission.revegetationimpl.document', 'uses' => 'Api\RevegetationImplController@document']);
    Route::put('revegetationimpl/{id}/image', ['as' => 'permission.revegetationimpl.image', 'uses' => 'Api\RevegetationImplController@image']);
    Route::put('revegetationimpl/{id}/galery', ['as' => 'permission.revegetationimpl.galery', 'uses' => 'Api\RevegetationImplController@galery']);
    Route::post('revegetationimpl/{id}/document', ['as' => 'permission.revegetationimpl.document', 'uses' => 'Api\RevegetationImplController@document']);
    Route::post('revegetationimpl/{id}/image', ['as' => 'permission.revegetationimpl.image', 'uses' => 'Api\RevegetationImplController@image']);
    Route::post('revegetationimpl/{id}/galery', ['as' => 'permission.revegetationimpl.galery', 'uses' => 'Api\RevegetationImplController@galery']);
    Route::post('revegetationimpl/{id}/implprogress', ['as' => 'permission.revegetationimpl.implprogress', 'uses' => 'Api\RevegetationImplController@implProgress']);

    Route::get('canalhoardingplan', ['as' => 'permission.canalhoardingplan.index', 'uses' => 'Api\CanalHoardingPlanController@index']);
    Route::post('canalhoardingplan', ['as' => 'permission.canalhoardingplan.store', 'uses' => 'Api\CanalHoardingPlanController@store']);
    Route::get('canalhoardingplan/{id}', ['as' => 'permission.canalhoardingplan.show', 'uses' => 'Api\CanalHoardingPlanController@show']);
    Route::put('canalhoardingplan/{id}', ['as' => 'permission.canalhoardingplan.update', 'uses' => 'Api\CanalHoardingPlanController@update']);
    Route::patch('canalhoardingplan/{id}', ['as' => 'permission.canalhoardingplan.updatepatch', 'uses' => 'Api\CanalHoardingPlanController@updatePatch']);
    Route::put('canalhoardingplan/{id}/status', ['as' => 'permission.canalhoardingplan.updatestatus', 'uses' => 'Api\CanalHoardingPlanController@updateStatus']);
    Route::patch('canalhoardingplan/{id}/cost', ['as' => 'permission.canalhoardingplan.updatecost', 'uses' => 'Api\CanalHoardingPlanController@updateAnggaran']);
    Route::delete('canalhoardingplan/{id}', ['as' => 'permission.canalhoardingplan.delete', 'uses' => 'Api\CanalHoardingPlanController@delete']);
    Route::put('canalhoardingplan/{id}/document', ['as' => 'permission.canalhoardingplan.document', 'uses' => 'Api\CanalHoardingPlanController@document']);
    Route::put('canalhoardingplan/{id}/image', ['as' => 'permission.canalhoardingplan.image', 'uses' => 'Api\CanalHoardingPlanController@image']);

    Route::get('canalhoardingimpl', ['as' => 'permission.canalhoardingimpl.index', 'uses' => 'Api\CanalHoardingImplController@index']);
//    Route::post('canalhoardingimpl', ['as' => 'permission.canalhoardingimpl.store', 'uses' => 'Api\CanalHoardingImplController@store']);
    Route::get('canalhoardingimpl/{id}', ['as' => 'permission.canalhoardingimpl.show', 'uses' => 'Api\CanalHoardingImplController@show']);
    Route::put('canalhoardingimpl/{id}', ['as' => 'permission.canalhoardingimpl.update', 'uses' => 'Api\CanalHoardingImplController@update']);
    Route::patch('canalhoardingimpl/{id}', ['as' => 'permission.canalhoardingimpl.updatepatch', 'uses' => 'Api\CanalHoardingImplController@updatePatch']);
    Route::put('canalhoardingimpl/{id}/status', ['as' => 'permission.canalhoardingimpl.updatestatus', 'uses' => 'Api\CanalHoardingImplController@updateStatus']);
    Route::delete('canalhoardingimpl/{id}', ['as' => 'permission.canalhoardingimpl.delete', 'uses' => 'Api\CanalHoardingImplController@delete']);
    Route::put('canalhoardingimpl/{id}/document', ['as' => 'permission.canalhoardingimpl.document', 'uses' => 'Api\CanalHoardingImplController@document']);
    Route::put('canalhoardingimpl/{id}/image', ['as' => 'permission.canalhoardingimpl.image', 'uses' => 'Api\CanalHoardingImplController@image']);
    Route::put('canalhoardingimpl/{id}/galery', ['as' => 'permission.canalhoardingimpl.galery', 'uses' => 'Api\CanalHoardingImplController@galery']);
    Route::post('canalhoardingimpl/{id}/document', ['as' => 'permission.canalhoardingimpl.document', 'uses' => 'Api\CanalHoardingImplController@document']);
    Route::post('canalhoardingimpl/{id}/image', ['as' => 'permission.canalhoardingimpl.image', 'uses' => 'Api\CanalHoardingImplController@image']);
    Route::post('canalhoardingimpl/{id}/galery', ['as' => 'permission.canalhoardingimpl.galery', 'uses' => 'Api\CanalHoardingImplController@galery']);
    Route::post('canalhoardingimpl/{id}/implprogress', ['as' => 'permission.canalhoardingimpl.implprogress', 'uses' => 'Api\CanalHoardingImplController@implProgress']);

    Route::get('canalblockplan', ['as' => 'permission.canalblockplan.index', 'uses' => 'Api\CanalblockPlanController@index']);
    Route::post('canalblockplan', ['as' => 'permission.canalblockplan.store', 'uses' => 'Api\CanalblockPlanController@store']);
    Route::get('canalblockplan/{id}', ['as' => 'permission.canalblockplan.show', 'uses' => 'Api\CanalblockPlanController@show']);
    Route::put('canalblockplan/{id}', ['as' => 'permission.canalblockplan.update', 'uses' => 'Api\CanalblockPlanController@update']);
    Route::patch('canalblockplan/{id}', ['as' => 'permission.canalblockplan.updatepatch', 'uses' => 'Api\CanalblockPlanController@updatePatch']);
    Route::put('canalblockplan/{id}/status', ['as' => 'permission.canalblockplan.updatestatus', 'uses' => 'Api\CanalblockPlanController@updateStatus']);
    Route::patch('canalblockplan/{id}/cost', ['as' => 'permission.canalblockplan.updatecost', 'uses' => 'Api\CanalblockPlanController@updateAnggaran']);
    Route::delete('canalblockplan/{id}', ['as' => 'permission.canalblockplan.delete', 'uses' => 'Api\CanalblockPlanController@delete']);
    Route::put('canalblockplan/{id}/document', ['as' => 'permission.canalblockplan.document', 'uses' => 'Api\CanalblockPlanController@document']);
    Route::put('canalblockplan/{id}/image', ['as' => 'permission.canalblockplan.image', 'uses' => 'Api\CanalblockPlanController@image']);
    Route::get('canalblockplan/{province_id}/geojson', ['as' => 'permission.canalblockplan.geojson', 'uses' => 'Api\CanalblockPlanController@geoJson']);

    Route::get('canalblockimpl', ['as' => 'permission.canalblockimpl.index', 'uses' => 'Api\CanalblockImplController@index']);
//    Route::post('canalblockimpl', ['as' => 'permission.canalblockimpl.store', 'uses' => 'Api\CanalblockImplController@store']);
    Route::get('canalblockimpl/{id}', ['as' => 'permission.canalblockimpl.show', 'uses' => 'Api\CanalblockImplController@show']);
    Route::put('canalblockimpl/{id}', ['as' => 'permission.canalblockimpl.update', 'uses' => 'Api\CanalblockImplController@update']);
    Route::patch('canalblockimpl/{id}', ['as' => 'permission.canalblockimpl.updatepatch', 'uses' => 'Api\CanalblockImplController@updatePatch']);
    Route::put('canalblockimpl/{id}/status', ['as' => 'permission.canalblockimpl.updatestatus', 'uses' => 'Api\CanalblockImplController@updateStatus']);
    Route::delete('canalblockimpl/{id}', ['as' => 'permission.canalblockimpl.delete', 'uses' => 'Api\CanalblockImplController@delete']);
    Route::put('canalblockimpl/{id}/document', ['as' => 'permission.canalblockimpl.document', 'uses' => 'Api\CanalblockImplController@document']);
    Route::put('canalblockimpl/{id}/image', ['as' => 'permission.canalblockimpl.image', 'uses' => 'Api\CanalblockImplController@image']);
    Route::put('canalblockimpl/{id}/galery', ['as' => 'permission.canalblockimpl.galery', 'uses' => 'Api\CanalblockImplController@galery']);
    Route::post('canalblockimpl/{id}/document', ['as' => 'permission.canalblockimpl.document', 'uses' => 'Api\CanalblockImplController@document']);
    Route::post('canalblockimpl/{id}/image', ['as' => 'permission.canalblockimpl.image', 'uses' => 'Api\CanalblockImplController@image']);
    Route::post('canalblockimpl/{id}/galery', ['as' => 'permission.canalblockimpl.galery', 'uses' => 'Api\CanalblockImplController@galery']);
    Route::post('canalblockimpl/{id}/implprogress', ['as' => 'permission.canalblockimpl.implprogress', 'uses' => 'Api\CanalblockImplController@implProgress']);

    Route::get('constructionplan', ['as' => 'permission.constructionplan.index', 'uses' => 'Api\ConstructionPlanController@index']);
    Route::post('constructionplan', ['as' => 'permission.constructionplan.store', 'uses' => 'Api\ConstructionPlanController@store']);
    Route::get('constructionplan/{id}', ['as' => 'permission.constructionplan.show', 'uses' => 'Api\ConstructionPlanController@show']);
    Route::put('constructionplan/{id}', ['as' => 'permission.constructionplan.update', 'uses' => 'Api\ConstructionPlanController@update']);
    Route::patch('constructionplan/{id}', ['as' => 'permission.constructionplan.updatepatch', 'uses' => 'Api\ConstructionPlanController@updatePatch']);
    Route::put('constructionplan/{id}/status', ['as' => 'permission.constructionplan.updatestatus', 'uses' => 'Api\ConstructionPlanController@updateStatus']);
    Route::patch('constructionplan/{id}/cost', ['as' => 'permission.constructionplan.updatecost', 'uses' => 'Api\ConstructionPlanController@updateAnggaran']);
    Route::delete('constructionplan/{id}', ['as' => 'permission.constructionplan.delete', 'uses' => 'Api\ConstructionPlanController@delete']);
    Route::put('constructionplan/{id}/document', ['as' => 'permission.constructionplan.document', 'uses' => 'Api\ConstructionPlanController@document']);
    Route::put('constructionplan/{id}/image', ['as' => 'permission.constructionplan.image', 'uses' => 'Api\ConstructionPlanController@image']);

    Route::get('constructionimpl', ['as' => 'permission.constructionimpl.index', 'uses' => 'Api\ConstructionImplController@index']);
//    Route::post('constructionimpl', ['as' => 'permission.constructionimpl.store', 'uses' => 'Api\ConstructionImplController@store']);
    Route::get('constructionimpl/{id}', ['as' => 'permission.constructionimpl.show', 'uses' => 'Api\ConstructionImplController@show']);
    Route::put('constructionimpl/{id}', ['as' => 'permission.constructionimpl.update', 'uses' => 'Api\ConstructionImplController@update']);
    Route::patch('constructionimpl/{id}', ['as' => 'permission.constructionimpl.updatepatch', 'uses' => 'Api\ConstructionImplController@updatePatch']);
    Route::put('constructionimpl/{id}/status', ['as' => 'permission.constructionimpl.updatestatus', 'uses' => 'Api\ConstructionImplController@updateStatus']);
    Route::delete('constructionimpl/{id}', ['as' => 'permission.constructionimpl.delete', 'uses' => 'Api\ConstructionImplController@delete']);
    Route::put('constructionimpl/{id}/document', ['as' => 'permission.constructionimpl.document', 'uses' => 'Api\ConstructionImplController@document']);
    Route::post('constructionimpl/{id}/document', ['as' => 'permission.constructionimpl.document', 'uses' => 'Api\ConstructionImplController@document']);

    Route::put('constructionimpl/{id}/image', ['as' => 'permission.constructionimpl.image', 'uses' => 'Api\ConstructionImplController@image']);
    // put dengan Form data problem di client, jadi untuk sementara menggunakanpost
    Route::post('constructionimpl/{id}/image', ['as' => 'permission.constructionimpl.image', 'uses' => 'Api\ConstructionImplController@image']);

    Route::put('constructionimpl/{id}/galery', ['as' => 'permission.constructionimpl.galery', 'uses' => 'Api\ConstructionImplController@galery']);
    Route::post('constructionimpl/{id}/galery', ['as' => 'permission.constructionimpl.galery', 'uses' => 'Api\ConstructionImplController@galery']);
    Route::post('constructionimpl/{id}/implprogress', ['as' => 'permission.constructionimpl.implprogress', 'uses' => 'Api\ConstructionImplController@implProgress']);

    Route::post('upload', ['as' => 'permission.upload.store', 'uses' => 'Api\UploadController@store']);

    Route::get('msubdistrict/{city_id}', ['as' => 'permission.subdistrict.all', 'uses' => 'Api\SubDistrictController@all']);
    Route::get('subdistrict', ['as' => 'permission.subdistrict.index', 'uses' => 'Api\SubDistrictController@index']);
    Route::post('subdistrict', ['as' => 'permission.subdistrict.store', 'uses' => 'Api\SubDistrictController@store']);
    Route::get('subdistrict/{id}', ['as' => 'permission.subdistrict.show', 'uses' => 'Api\SubDistrictController@show']);
    Route::put('subdistrict/{id}', ['as' => 'permission.subdistrict.update', 'uses' => 'Api\SubDistrictController@update']);
//    Route::delete('subdistrict/{id}', ['as' => 'permission.subdistrict.delete', 'uses' => 'Api\SubDistrictController@delete']);

    Route::get('mcity/{province_id}', ['as' => 'permission.city.all', 'uses' => 'Api\CityController@all']);
    Route::get('city', ['as' => 'permission.city.index', 'uses' => 'Api\CityController@index']);
    Route::post('city', ['as' => 'permission.city.store', 'uses' => 'Api\CityController@store']);
    Route::get('city/{id}', ['as' => 'permission.city.show', 'uses' => 'Api\CityController@show']);
    Route::put('city/{id}', ['as' => 'permission.city.update', 'uses' => 'Api\CityController@update']);
//    Route::delete('city/{id}', ['as' => 'permission.city.delete', 'uses' => 'Api\CityController@delete']);

    Route::get('mprovince', ['as' => 'permission.province.all', 'uses' => 'Api\ProvinceController@all']);
    Route::get('province/targeted', ['as' => 'permission.province.targeted', 'uses' => 'Api\ProvinceController@enabled']);
    Route::get('province', ['as' => 'permission.province.index', 'uses' => 'Api\ProvinceController@index']);
    Route::post('province', ['as' => 'permission.province.store', 'uses' => 'Api\ProvinceController@store']);
    Route::get('province/{id}', ['as' => 'permission.province.show', 'uses' => 'Api\ProvinceController@show']);
    Route::put('province/{id}', ['as' => 'permission.province.update', 'uses' => 'Api\ProvinceController@update']);
//    Route::delete('province/{id}', ['as' => 'permission.province.delete', 'uses' => 'Api\ProvinceController@delete']);

    Route::get('mfundingsource', ['as' => 'permission.fundingsource.all', 'uses' => 'Api\FundingSourceController@all']);
    Route::get('fundingsource', ['as' => 'permission.fundingsource.index', 'uses' => 'Api\FundingSourceController@index']);
    Route::post('fundingsource', ['as' => 'permission.fundingsource.store', 'uses' => 'Api\FundingSourceController@store']);
    Route::get('fundingsource/{id}', ['as' => 'permission.fundingsource.show', 'uses' => 'Api\FundingSourceController@show']);
    Route::put('fundingsource/{id}', ['as' => 'permission.fundingsource.update', 'uses' => 'Api\FundingSourceController@update']);
//    Route::delete('fundingsource/{id}', ['as' => 'permission.fundingsource.delete', 'uses' => 'Api\FundingSourceController@delete']);


    Route::get('mburnstatus', ['as' => 'permission.mburnstatus.all', 'uses' => 'Api\BurnStatusController@all']);
    Route::get('mvegetationdensity', ['as' => 'permission.mvegetationdensity.all', 'uses' => 'Api\VegetationDensityController@all']);
    Route::get('mrevegetationtype', ['as' => 'permission.mrevegetationtype.all', 'uses' => 'Api\RevegetationTypeController@all']);

    Route::get('mcanaltype', ['as' => 'permission.canaltype.all', 'uses' => 'Api\CanalTypeController@all']);
    Route::get('mcanalblockingtype', ['as' => 'permission.canalblockingtype.all', 'uses' => 'Api\CanalBlockingTypeController@all']);

    Route::get('mstatus', ['as' => 'permission.status.all', 'uses' => 'Api\StatusController@all']);
    Route::get('status', ['as' => 'permission.status.index', 'uses' => 'Api\StatusController@index']);
    Route::post('status', ['as' => 'permission.status.store', 'uses' => 'Api\StatusController@store']);
    Route::get('status/{id}', ['as' => 'permission.status.show', 'uses' => 'Api\StatusController@show']);
    Route::put('status/{id}', ['as' => 'permission.status.update', 'uses' => 'Api\StatusController@update']);
//    Route::delete('status/{id}', ['as' => 'permission.status.delete', 'uses' => 'Api\StatusController@delete']);

    Route::get('mzonetype', ['as' => 'permission.zonetype.all', 'uses' => 'Api\ZoneTypeController@all']);
    Route::get('zonetype', ['as' => 'permission.zonetype.index', 'uses' => 'Api\ZoneTypeController@index']);
    Route::post('zonetype', ['as' => 'permission.zonetype.store', 'uses' => 'Api\ZoneTypeController@store']);
    Route::get('zonetype/{id}', ['as' => 'permission.zonetype.show', 'uses' => 'Api\ZoneTypeController@show']);
    Route::put('zonetype/{id}', ['as' => 'permission.zonetype.update', 'uses' => 'Api\ZoneTypeController@update']);
//    Route::delete('zonetype/{id}', ['as' => 'permission.zonetype.delete', 'uses' => 'Api\ZoneTypeController@delete']);

    Route::get('mtype', ['as' => 'permission.type.all', 'uses' => 'Api\TypeController@all']);
    Route::get('type', ['as' => 'permission.type.index', 'uses' => 'Api\TypeController@index']);
    Route::post('type', ['as' => 'permission.type.store', 'uses' => 'Api\TypeController@store']);
    Route::get('type/{id}', ['as' => 'permission.type.show', 'uses' => 'Api\TypeController@show']);
    Route::put('type/{id}', ['as' => 'permission.type.update', 'uses' => 'Api\TypeController@update']);
//    Route::delete('type/{id}', ['as' => 'permission.type.delete', 'uses' => 'Api\TypeController@delete']);

    Route::get('mphu', ['as' => 'permission.phu.all', 'uses' => 'Api\PhuController@all']);
    Route::get('phu', ['as' => 'permission.phu.index', 'uses' => 'Api\PhuController@index']);
    Route::post('phu', ['as' => 'permission.phu.store', 'uses' => 'Api\PhuController@store']);
    Route::get('phu/{id}', ['as' => 'permission.phu.show', 'uses' => 'Api\PhuController@show']);
    Route::put('phu/{id}', ['as' => 'permission.phu.update', 'uses' => 'Api\PhuController@update']);
//    Route::delete('phu/{id}', ['as' => 'permission.phu.delete', 'uses' => 'Api\PhuController@delete']);

    Route::get('organization', ['as' => 'permission.organization.index', 'uses' => 'Api\OrganizationController@index']);
    Route::post('organization', ['as' => 'permission.organization.store', 'uses' => 'Api\OrganizationController@store']);
    Route::get('organization/{id}', ['as' => 'permission.organization.show', 'uses' => 'Api\OrganizationController@show']);
    Route::put('organization/{id}', ['as' => 'permission.organization.update', 'uses' => 'Api\OrganizationController@update']);
    Route::delete('organization/{id}', ['as' => 'permission.organization.delete', 'uses' => 'Api\OrganizationController@delete']);


    Route::get('me', ['as' => 'permission.login.me', 'uses' => 'Api\LoginController@me']);

    Route::get('user', ['as' => 'permission.user.index', 'uses' => 'Api\UserController@index']);
    Route::post('user', ['as' => 'permission.user.store', 'uses' => 'Api\UserController@store']);
    Route::get('user/{id}', ['as' => 'permission.user.show', 'uses' => 'Api\UserController@show']);
    Route::put('user/{id}', ['as' => 'permission.user.update', 'uses' => 'Api\UserController@update']);
    Route::delete('user/{id}', ['as' => 'permission.user.delete', 'uses' => 'Api\UserController@delete']);

    Route::get('person', ['as' => 'permission.person.index', 'uses' => 'Api\PersonController@index']);
    Route::post('person', ['as' => 'permission.person.store', 'uses' => 'Api\PersonController@store']);
    Route::get('person/{id}', ['as' => 'permission.person.show', 'uses' => 'Api\PersonController@show']);
    Route::put('person/{id}', ['as' => 'permission.person.update', 'uses' => 'Api\PersonController@update']);
    Route::delete('person/{id}', ['as' => 'permission.person.delete', 'uses' => 'Api\PersonController@delete']);

    Route::get('personal',['as' => 'permission.personal.index','uses'=>'Api\PersonalController@index']);
    Route::post('personal',['as' => 'permission.personal.store','uses'=>'Api\PersonalController@store']);
    Route::get('personal/listuser',['as' => 'permission.personal.listuser','uses'=>'Api\PersonalController@listuser']);
    Route::get('personal/tampil',['as' => 'permission.personal.tampil','uses'=>'Api\PersonalController@tampil']);
    Route::get('personal/{id}',['as' => 'permission.personal.show','uses'=>'Api\PersonalController@show']);
    Route::put('personal/{id}',['as' => 'permission.personal.update','uses'=>'Api\PersonalController@update']);
    Route::delete('personal/{id}',['as' => 'permission.personal.delete','uses'=>'Api\PersonalController@delete']);
    
    Route::get('donordash/anggaran',['as'=>'permission.donordash.anggaran', 'uses'=>'Api\DonorDashController@anggaran']);
    Route::get('donordash/berdasarkegiatan',['as'=>'permission.donordash.berdasarkegiatan','uses'=>'Api\DonorDashController@berdasarkegiatan']);
    Route::get('donordash/wil',['as'=>'permission.donordash.berdasarwil', 'uses'=>'Api\DonorDashController@berdasarWil']);
    Route::get('donordash/summary',['as'=>'permission.donordash.summary', 'uses'=>'Api\DonorDashController@summary']);
    Route::get('donordash/v2provinsi',['as'=>'permission.donordash.v2provinsi', 'uses'=>'Api\DonorDashController@v2provinsi']);
    Route::get('donordash/v3profile',['as'=>'permission.donordash.v3profile', 'uses'=>'Api\DonorDashController@v3profile']);
   // Route::get('donordash',['as'=>'permission.donordash.store','uses'=>'Api\DonorDashController@store']);

//    Route::get('/donordash/plan-anggaran', ['as' => 'permission.donordash.anggaran', 'uses' => 'Api\DonorDashCOntroller@anggaran']);
//     Route::get('/donordash/total-cost-plan', ['as' => 'permission.donordash.totalcost', 'uses' => 'Api\DonorDashCOntroller@totalCost']);
//     Route::get('/donordash/cost-by-funding-source-plan', ['as' => 'permission.donordash.costbyfundingsource', 'uses' => 'Api\DonorDashCOntroller@costByFundingSource']);
//     Route::get('/donordash/cost-by-province-plan', ['as' => 'permission.donordash.costbyprovince', 'uses' => 'Api\DonorDashCOntroller@costByProvince']);
//     Route::get('/donordash/total-area-plan', ['as' => 'permission.donordash.totalarea', 'uses' => 'Api\DonorDashCOntroller@totalArea']);
//     Route::get('/donordash/area-by-province-plan', ['as' => 'permission.donordash.areabyprovince', 'uses' => 'Api\DonorDashCOntroller@areaByProvince']);
//     Route::get('/donordash/total-action-plan', ['as' => 'permission.donordash.totalaction', 'uses' => 'Api\DonorDashCOntroller@totalAction']);
//     Route::get('/donordash/action-by-province-plan', ['as' => 'permission.donordash.actionbyprovince', 'uses' => 'Api\DashboardController@actionByProvince']);

    Route::get('donordash', ['as' => 'permission.donordash.index', 'uses' => 'Api\DonorDashController@index']);
    Route::post('donordash', ['as' => 'permission.donordash.store', 'uses' => 'Api\DonorDashController@store']);
   // Route::get('donordash/{id}', ['as' => 'permission.donordash.show', 'uses' => 'Api\DonorDashController@show']);
    Route::put('donordash/{id}', ['as' => 'permission.donordash.update', 'uses' => 'Api\DonorDashController@update']);
//    Route::delete('donoractivities/{id}', ['as' => 'permission.donoractivities.delete', 'uses' => 'Api\DonorActivityController@delete']);
    Route::put('donordash/{id}/status', ['as' => 'permission.donordash.updatestatus', 'uses' => 'Api\DonorDashController@updateStatus']);
       Route::get('/donordash/anggaran', ['as' => 'permission.donordash.anggaran', 'uses' => 'Api\DonorDashController@anggaran']);
       Route::get('/donordash/peatlandrewetting', ['as' => 'permission.donordash.peatlandrewetting', 'uses' => 'Api\DonorDashController@peatlandrewetting']);
       Route::get('/donordash/revegetation', ['as' => 'permission.donordash.revegetation', 'uses' => 'Api\DonorDashController@revegetation']);
       Route::get('/donordash/revitalization', ['as' => 'permission.donordash.revitalization', 'uses' => 'Api\DonorDashController@revitalization']);
       Route::get('/donordash/baseStabilization', ['as' => 'permission.donordash.baseStabilization', 'uses' => 'Api\DonorDashController@baseStabilization']);
       Route::get('/donordash/instStrengthening', ['as' => 'permission.donordash.instStrengthening', 'uses' => 'Api\DonorDashController@instStrengthening']);
       Route::get('/donordash/coopImprove', ['as' => 'permission.donordash.coopImprove', 'uses' => 'Api\DonorDashController@coopImprove']);
       Route::get('/donordash/actifRoles', ['as' => 'permission.donordash.actifRoles', 'uses' => 'Api\DonorDashController@actifRoles']);
       Route::get('/donordash/peatlandRestoration', ['as' => 'permission.donordash.peatlandRestoration', 'uses' => 'Api\DonorDashController@peatlandRestoration']);
       Route::get('/donordash/administrartionManagement', ['as' => 'permission.donordash.administrartionManagement', 'uses' => 'Api\DonorDashController@administrartionManagement']);
       Route::get('/donordash/costByProvince', ['as'=>'permission.donordash.costByProvince', 'uses'=>'Api\DonorDashController@costByProvince']);
        Route::get('/donordash/costByProvince', ['as'=>'permission.donordash.costByProvince', 'uses'=>'Api\DonorDashController@costByProvince']);
       Route::get('/donordash/costByActivity', ['as'=>'permission.donordash.costByActivity', 'uses'=>'Api\DonorDashController@costByActivity']);
       Route::get('/donordash/totallembaga', ['as'=>'permission.donordash.totallembaga', 'uses'=>'Api\DonorDashController@totallembaga']);
       Route::get('/donordash/totalkegiatan', ['as' => 'permission.donordash.totalkegiatan', 'uses' => 'Api\DonorDashController@totalkegiatan']);

//     Route::get('donordash', ['as' => 'permission.donordash.index', 'uses' => 'Api\DonorDashController@index']);
//     Route::post('donordash', ['as' => 'permission.donordash.store', 'uses' => 'Api\DonorDashController@store']);
//     Route::get('donordash/{id}', ['as' => 'permission.donordash.show', 'uses' => 'Api\DonorDashController@show']);
//     Route::put('donordash/{id}', ['as' => 'permission.donordash.update', 'uses' => 'Api\DonorDashController@update']);
// //    Route::delete('donoractivities/{id}', ['as' => 'permission.donoractivities.delete', 'uses' => 'Api\DonorActivityController@delete']);
//     Route::put('donordash/{id}/status', ['as' => 'permission.donordash.updatestatus', 'uses' => 'Api\DonorDashController@updateStatus']);

        Route::get('organisasi',['as' => 'permission.organisasi.index','uses'=>'Api\OrganisasiController@index']);
        Route::post('organisasi',['as' => 'permission.organisasi.store','uses'=>'Api\OrganisasiController@store']);
        Route::get('organisasi/{id}',['as' => 'permission.organisasi.show','uses'=>'Api\OrganisasiController@show']);
        Route::put('organisasi/{id}',['as' => 'permission.organisasi.update','uses'=>'Api\OrganisasiController@update']);
        Route::delete('organisasi/{id}',['as' => 'permission.organisasi.delete','uses'=>'Api\OrganisasiController@delete']);
});

