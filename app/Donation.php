<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    //
  public function name() {
    return $this->belongsTo(Name::class, 'id', 'name_id');
  }
}
