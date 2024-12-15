<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorseImagesTable extends Migration
{
    public function up()
    {
        Schema::create('horse_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('horse_listing_id')->constrained('horse_listings')->onDelete('cascade'); // Link to horse listing
            $table->string('image_path'); // The path to the image file
            $table->boolean('is_main')->default(false); // Whether the image is the main image
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('horse_images');
    }
}
