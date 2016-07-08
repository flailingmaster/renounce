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

Route::get('/', function () {
    //return view('welcome');
    $reports = Report::orderBy('publication_date', 'asc')->get();
    return view('reports', ['reports' => $reports]);
});

Route::resource('report', 'ReportController', ['only' => [
    'index', 'show'
]]);

Route::resource('name', 'NameController', ['only' => [
    'index', 'show'
]]);
