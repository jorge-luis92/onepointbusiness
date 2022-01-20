<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGananciasToDetailsales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detailsales', function (Blueprint $table) {
              $table->double('ganancias')->after('precio_pub')->default(0);
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
              $table->dropColumn('ganancias');
        });
    }
}
