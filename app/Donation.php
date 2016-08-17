<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    //
  protected $fillable = ['raw_name', 'name_id', 'donation_date', 'location', 'occupation', 'amount', 'recipient'];
  
  public function name() {
    return $this->belongsTo(Name::class, 'id', 'name_id');
  }
}
