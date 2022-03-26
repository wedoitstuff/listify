<?php

use Illuminate\Support\Facades\Route;
use App\Models\Listify;
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
Route::post('/newEntry', function () {
    echo "<pre>";
    print_r($_POST);
});
Route::get('/dataTest', function () {
    $list=Listify::all();
    foreach($list as $x){
        echo $x->todo . "<br>";
    }
});