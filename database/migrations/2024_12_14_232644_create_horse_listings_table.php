<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorseListingsTable extends Migration
{
    public function up()
    {
        Schema::create('horse_listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users'); // Reference to the 'users' table
            $table->string('horse_name');
            $table->string('breed');
            $table->integer('age');
            $table->string('gender');
            $table->float('height');
            $table->text('description');
            $table->text('loan_terms');
            $table->boolean('availability')->default(1);
            $table->decimal('price', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('horse_listings');
    }
}
