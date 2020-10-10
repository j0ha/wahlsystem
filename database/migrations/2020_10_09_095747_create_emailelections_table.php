<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailelectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emailelections', function (Blueprint $table) {
          $table->id();
          $table->String('name');
          $table->integer('participants');
          $table->boolean('abstention');
          $table->char('status', 16)->default(1);
          $table->uuid('uuid');
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emailelections');
    }
}
