<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
  protected $primaryKey = null;
public $incrementing = false;

protected $table = 'events';
protected $fillable = [
  'id','nombre_persona', 'producto', 'tipo_evento', 'cantidad', 'motivo',
];

}
