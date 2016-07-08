<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Name;

class Report extends Model
{
  protected $fillable = [];
  public function names()
  {
      return $this->hasMany(Name::class, 'document_number', 'document_number');
  }
}
