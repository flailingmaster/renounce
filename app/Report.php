<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Name;

class Report extends Model
{
  protected $fillable = [];
  public function names()
  {
      return $this->hasMany('Name', 'document_number');
  }

  public function namesCount()
  {
    return $this->names()
      ->selectRaw('document_number, count(*) as aggregate')
      ->groupBy('document_number');

  }
}
