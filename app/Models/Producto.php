<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{

    protected $table = 'products';
  protected $fillable = [
      'nombre', 'tipo','precio_may','precio','unidad', 'unidad_venta', 'stock', 'status','promocion',
  ];
}
