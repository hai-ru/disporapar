<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColectingFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colecting_forms', function (Blueprint $table) {
            $table->id();
            $table->string("column_name");
            $table->enum("column_type",["multiline","text","number"]);
            $table->timestamps();

            $table->foreignId('colecting_category_id')
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
        Schema::dropIfExists('colecting_forms');
    }
}
