<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewsController;
use App\Http\Controllers\ApiController;
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
    return view('index');
});
Route::get('/', [ViewsController::class, 'index']);

//Authentication routes
Route::get('/login',[ViewsController::class, 'login'])-> name('login');
Route::post('/login', [ViewsController::class, 'loginProcess']);
Route::get('/signup',[ViewsController::class, 'signup']);
Route::post('/signup', [ViewsController::class, 'signupProcess']);


//dashboard routes
Route::group(['middleware' => ['auth']], function() {
    Route::redirect('/dashboard','/dashboard/overview');
    Route::get('/dashboard/overview',[ViewsController::class, 'DashboardOverview']);
    Route::redirect('/dashboard/wallet','/dashboard/wallet/btc');

	Route::get('/dashboard/wallet/{coin}',[ViewsController::class, 'DashboardWallet']);
	Route::get('/dashboard/settings',[ViewsController::class, 'DashboardSettings']);
	Route::get('/dashboard/notifications',[ViewsController::class, 'DashboardNotifications']);
	Route::get('/dashboard/trends',[ViewsController::class, 'DashboardTrends']);
	Route::post('/dashboard/settings',[ViewsController::class, 'DeleteAccount']);
});