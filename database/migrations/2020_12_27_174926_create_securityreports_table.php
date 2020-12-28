<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecurityreportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('securityreports', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('description');
            $table->text('error')->nullable();
            $table->char('file')->nullable();
            $table->uuid('election_uuid');
            $table->char('importance');
            $table->char('additional_info');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('securityreports');
    }
}
