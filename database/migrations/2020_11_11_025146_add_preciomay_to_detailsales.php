<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPreciomayToDetailsales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::table('detailsales', function (Blueprint $table) {
               $table->double('precio_may')->after('total')->default(0);
         });
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
         Schema::table('detailsales', function (Blueprint $table) {
               $table->dropColumn('precio_may');
         });
     }
}
