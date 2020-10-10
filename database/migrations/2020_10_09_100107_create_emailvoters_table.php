<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailvotersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emailvoters', function (Blueprint $table) {
          $table->id();
          $table->uuid('uuid');
          $table->uuid('direct_uuid');
          $table->integer('emailelection_id');
          $table->boolean('voted');
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
        Schema::dropIfExists('emailvoters');
    }
}
