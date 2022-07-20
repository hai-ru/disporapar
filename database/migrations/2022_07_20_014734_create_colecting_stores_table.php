<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColectingStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colecting_stores', function (Blueprint $table) {
            $table->id();
            $table->text('attach_models')->nullable();
            $table->integer('attach_to')->nullable();
            $table->text('value');
            $table->timestamps();
            $table->foreignId('colecting_forms_id')
            ->nullable()
            ->references('id')->on('colecting_forms')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('colecting_categories_id')
            ->nullable()
            ->references('id')->on('colecting_categories')
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
        Schema::dropIfExists('colecting_stores');
    }
}
