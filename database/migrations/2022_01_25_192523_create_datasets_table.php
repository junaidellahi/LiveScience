<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatasetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datasets', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignID('study_id');
            $table->string('name');
            $table->string('description');
            $table->string('file');
            
            $table->foreign('study_id')->references('id')->on('studies')->onDelete('cascade');
            
            
        });
    }

    /**
     * Reverse the migrations.
     *p
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datasets');
    }
}
