<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use App\Report;
use App\Name;

Route::get('/', function () {
    //return view('welcome');
    $reports = Report::orderBy('publication_date', 'asc')->get();
    return view('reports', ['reports' => $reports]);
});

Route::resource('report', 'ReportController', ['only' => [
    'index', 'show'
]]);

Route::get('name/donated', function () {
    $names = Name::where('raw_count', '>', 0)->orderBy('raw_count', 'desc')->paginate(100);
    return view('names', ['names' => $names]);
});

Route::resource('name', 'NameController', ['only' => [
    'index', 'show'
]]);
