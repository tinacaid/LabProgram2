<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post('editScienceStar',[\App\Http\Controllers\MhwController::class,"editScienceStar"]);//科技之星学生信息修改
Route::post('admin/login',[\App\Http\Controllers\MhwController::class,"adminlogin"]);//科技之星学生信息修改
//Route::post('admin/logout',[\App\Http\Controllers\MhwController::class,"adminlogout"]);
Route::post('user/editCompetitionStar',[\App\Http\Controllers\MhwController::class,"usereditCompetitionStar"]);
Route::post('adminzhuce',[\App\Http\Controllers\MhwController::class,"zhuceadmin"]);
Route::middleware('jwt.role:administrators')->prefix('administrators')->group(function () {
    Route::post('logout',[\App\Http\Controllers\MhwController::class,'adminlogout']);//登出用户

});
Route::post('user/addInnovationStar',[\App\Http\Controllers\MhwController::class,"useraddInnovationStar"]);
//Route::middleware('jwt.role:student')->prefix('student')->group(function (){
   // Route::post('logout', [\App\Http\Controllers\MhwController::class, 'adminlogout1']);//学生登出
//});


