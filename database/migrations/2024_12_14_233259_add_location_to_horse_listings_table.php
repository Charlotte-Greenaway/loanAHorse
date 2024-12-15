<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('horse_listings', function (Blueprint $table) {
            $table->string('location')->nullable();  // You can also choose other column types or constraints
        });
    }

    public function down()
    {
        Schema::table('horse_listings', function (Blueprint $table) {
            $table->dropColumn('location');
        });
    }

};
