<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
  protected $table = 'sales';
protected $fillable = [
    'total_vendido', 'id_user', 'totalventa',
];
}
