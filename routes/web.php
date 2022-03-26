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
})->name('Dashboard');
Route::post('/newEntry', function () {
    $entry = $_POST['entry'];
    $date = $_POST['date'];

    $todo = new Listify;
    $todo->date=$date;
    $todo->todo=$entry;
    $todo->status=0;
    $todo->save();

    return redirect()->route('Dashboard');
});
Route::get('/dataTest', function () {
    $list=Listify::all();
    foreach($list as $x){
        echo $x->todo . "<br>";
    }
});
Route::get('/editEntry/{id}', function ($id) {
    echo 'Entry ID = '.  $id;
});
Route::get('/deleteEntry/{id}', function ($id) {
    $list = Listify::find($id);
    $list->delete();

    return redirect()->route('Dashboard');
});