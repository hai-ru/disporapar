<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->point('location');
            $table->string('phone')->nullable();
            $table->float('rating')->default(0);
            $table->json('photos')->nullable();
            $table->text('description')->nullable();
            $table->integer('views')->default(0);
            $table->json('google_places_api')->nullable();
            $table->timestamps();

            $table->foreignId('category_place_id')
            ->references('id')->on('category_places')
            ->onUpdate('cascade')
            ->onDelete('cascade')
            ->nullable();

            $table->foreignId('wilayah_id')
            ->references('id')->on('wilayahs')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('places');
    }
}
