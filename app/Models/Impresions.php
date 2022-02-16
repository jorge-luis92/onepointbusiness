<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Impresions extends Model
{
    use HasFactory;

    protected $table = 'impresions';
  protected $fillable = [
      'total_impresiones', 'creacion_impresiones',
  ];
}
