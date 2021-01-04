<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('name_h');
            $table->text('description')->nullable();
            $table->text('image')->nullable();
            $table->integer('election_id');
            $table->integer('votes')->default(0);
            $table->text('uuid');
            $table->text('type');
            $table->integer('level');
            $table->boolean('deletable')->default(true);
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
        Schema::dropIfExists('candidates');
    }
}
