<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use App\Producto;
use App\Detailsale;
use App\Sale;

class UsersExport implements FromCollection
{
  use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
      $consulta = DB::table('users')
         ->select('users.id', 'users.name', 'users.email')
         ->get();

        return $consulta;
    }
}
