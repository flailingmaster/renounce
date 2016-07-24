<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Name;
use App\Helpers\Contracts\OpenSecretsContract;

class NameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $names = Name::orderBy('document_number', 'asc')->paginate(500);
       return view('names', ['names' => $names]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, OpenSecretsContract $opensecrets)
    {
        $name = Name::with(['donations'])->findOrFail($id);
        $service_run = FALSE;
        $parsed_donations = [];
        if($name->queried == FALSE) {
          $this->refresh_cache($name, $opensecrets);
        } else {
          $parsed_donations = json_decode($name->cached_raw);
        }

        return view('name', ['name' => $name, 'service_run' => $service_run, 'parsed_donations' => $parsed_donations]);
    }

    /**
     * Run Open Secrets Lookup and update raw cache
     *
     * @param  int  $id, OpenSecretsContract $opensecrets
     * @return none
     */
    public function refresh_cache($name, OpenSecretsContract $opensecrets)
    {

      $raw_result = $opensecrets->lookup($name->name);
      $service_run = TRUE;
      $name->queried = TRUE;

      $name->raw_count = count($raw_result);
      if ($name->raw_count == 0) {
        $name->cached_raw = NULL;
      } else {
        $name->cached_raw = json_encode($raw_result);
        $parsed_donations = $raw_result;
      }
      $name->save();
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
