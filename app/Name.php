<?php

namespace App;
use App\Report;

use Illuminate\Database\Eloquent\Model;

class Name extends Model
{
    //
  public function report() {
    return $this->belongsTo(Report::class, 'document_number', 'document_number');
  }
}
