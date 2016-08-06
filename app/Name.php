<?php

namespace App;
use App\Report;
use App\Donation;
use App\Helpers\Contracts\OpenSecretsContract;

use Illuminate\Database\Eloquent\Model;

class Name extends Model
{
  protected $fillable = array('name', 'document_number');
    //
  public function report() {
    return $this->belongsTo(Report::class, 'document_number', 'document_number');
  }

  public function donations()
  {
      return $this->hasMany(Donation::class);
  }
}
