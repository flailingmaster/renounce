<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Name extends Model
{
    //
  public function report() {
    return $this->belongsTo('Report', 'document_number');
  }
}
