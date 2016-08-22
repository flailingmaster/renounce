<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Donation;

class DonationController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $donations = Donation::orderBy('raw_name', 'asc')->paginate(500);
    return view('donations', ['donations' => $donations]);
  }
}
