<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detailsale extends Model
{
  protected $primaryKey = null;
public $incrementing = false;

protected $table = 'detailsales';
protected $fillable = [
  'id', 'produto', 'tipo', 'cantidad_vendida', 'total', 'precio_may', 'precio_pub', 'ganancias', 'creacion',
];
}
