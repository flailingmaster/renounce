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

// "name" "location" “year of expatriation” and “year of most recent donation”
Route::get('name/simpleview', function () {
  $most_recent_donations = DB::select("SELECT name_id, location, MAX(donation_date) FROM donation d GROUP BY name_id, location");

  /* foreach ($most_recent_donations as $name_id, location)
  SELECT name_id, location, MAX(donation_date) FROM donation d GROUP BY name_id, location;

  SELECT d.name_id, n.name, d.location, r.publication_date, MAX(d.donation_date) 
  FROM donations d
  JOIN names n ON d.name_id = n.id
  JOIN reports r ON n.document_number = r.id
  GROUP BY d.name_id, d.location;

  */

});

// "name" “total donations ($)” “first year donation detected” “most recent year donation detected”
Route::get('name/donatedetails', function () {
});

// "names donated after expatriation"
Route::get('name/donatedafter', function () {
    $donations = Donation::all();
    return view('donations_after', ['donations' => $donations]);
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

Route::resource('donation', 'DonationController', ['only' => [
    'index', 'show'
]]);
