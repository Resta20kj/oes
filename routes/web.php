<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use Faker\Guesser\Name;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//REGISTER
Route::get('/register',[AuthController::class,'loadRegister']);
Route::post('/register',[AuthController::class,'studentRegister'])->name('studentRegister');

//LOGIN
Route::get('/login', function () {
    return redirect('/');
});
Route::get('/',[AuthController::class,'loadLogin']);
Route::post('/login',[AuthController::class,'userLogin'])->name('userLogin');

//LOGOUT
Route::get('/logout',[AuthController::class,'logout']);

//FORGET PASSWORD
Route::get('/forget-password', [AuthController::class, 'forgetPasswordLoad']);
Route::post('/forget-password',[AuthController::class,'forgetPassword'])->name('forgetPassword');

Route::group(['middleware'=>['web','checkAdmin']], function(){
    Route::get('/admin/dashboard',[AuthController::class,'adminDashboard']);
    
    //Subject Route
    Route::post('/add-subject',[AdminController::class,'addSubject'])->name('addSubject');
    Route::post('/edit-subject',[AdminController::class,'editSubject'])->name('editSubject');
    Route::post('/delete-subject',[AdminController::class,'deleteSubject'])->name('deleteSubject');
});

Route::group(['middleware'=>['web','checkStudent']], function(){
    Route::get('/dashboard',[AuthController::class,'loadDashboard']);
});