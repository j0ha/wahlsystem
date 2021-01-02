<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voters', function (Blueprint $table) {
            $table->id();
            $table->text('surname')->nullable();
            $table->text('name')->nullable();
            $table->text('birth_year')->nullable();
            $table->boolean('voted_via_email')->default(false);
            $table->boolean('voted_via_terminal')->default(false);
            $table->boolean('got_email')->default(false);
            $table->text('uuid');
            $table->text('direct_uuid')->nullable();
            $table->text('direct_token')->nullable();
            $table->text('email')->nullable();
            $table->integer('election_id');
            $table->integer('schoolclass_id')->nullable();
            $table->integer('form_id')->nullable();
            $table->boolean('activated')->default(1);
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
        Schema::dropIfExists('voters');
    }
}
