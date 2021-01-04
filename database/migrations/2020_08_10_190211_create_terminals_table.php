<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTerminalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terminals', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('kind');
            $table->text('description');
            $table->text('name_h');
            $table->text('description_h');
            $table->text('position');
            $table->text('position_h');
            $table->text('status');
            $table->text('start_time')->nullable();
            $table->text('end_time')->nullable();
            $table->text('ip_restriction')->nullable();
            $table->text('uuid');
            $table->integer('election_id');
            $table->integer('hits')->default(0);
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
        Schema::dropIfExists('terminals');
    }
}
