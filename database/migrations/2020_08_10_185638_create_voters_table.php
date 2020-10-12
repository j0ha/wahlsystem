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
            $table->string('surname');
            $table->string('name');
            $table->date('birth_year')->default('1111-11-11');
            $table->boolean('voted_via_email')->default(false);
            $table->boolean('voted_via_terminal')->default(false);
            $table->boolean('got_email')->default(false);
            $table->uuid('uuid');
            $table->uuid('direct_uuid');
            $table->char('direct_token')->nullable();
            $table->string('email');
            $table->integer('election_id');
            $table->integer('schoolclass_id');
            $table->integer('form_id');
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
