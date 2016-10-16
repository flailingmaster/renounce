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
use App\Donation;
//use Cache;

Route::get('/', function () {
    //return view('welcome');
    $reports = Report::orderBy('publication_date', 'asc')->get();
    //$reports_wo_names = Report::where('raw_count', 0)->count();
    //count for each report $report->names()->count()
    $num_reports = Report::all()->count();
    $names_w_donations = Name::where('raw_count', ">", 0)->count();
    $num_empty_reports = DB::select('select count(*) as count from
    (select reports.id, reports.document_number from reports left join names on reports.document_number = names.document_number group by reports.id having count(names.id) = 0) as temp');
    $num_names = Name::all()->count();
    $num_donations = Name::all()->sum('raw_count');
    $num_unqueried = Name::where('queried', false)->count();
    return view('reports', ['reports' => $reports, 'num_reports' => $num_reports, 'names_w_donations' => $names_w_donations, 'num_names' => $num_names, 'num_empty_reports' => $num_empty_reports[0], 'num_donations' => $num_donations, 'num_unqueried' => $num_unqueried]);
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

Route::get('donation/raw', function () {
    $donations = Cache::remember('donations', 10, function() {
      return Donation::all();
    });

    return view('donations_raw', ['donations' => $donations]);
});

//Would be helpful to have a sheet of ONLY the names that appear in both places (election donations & expatriation) with a field for “year of expatriation” and “year of most recent donation”
//Would be helpful to have a sheet of ONLY people who appear in both places and fields “total donations ($)” “first year donation detected” “most recent year donation detected”
//Would be helpful to have a sheet of ONLY people who seem to have made a donation after their expatriation publication year (I’ll check these manually)

Route::resource('donation', 'DonationController', ['only' => [
    'index', 'show'
]]);
