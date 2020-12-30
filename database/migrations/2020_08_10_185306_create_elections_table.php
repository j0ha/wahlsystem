<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elections', function (Blueprint $table) {
            $table->id();
            $table->String('name');
            $table->String('description');
            $table->boolean('abstention');
            $table->boolean('statistics');
            $table->char('status', 16)->default(0);
            $table->uuid('uuid');
            $table->char('type');
            $table->integer('permission_id')->nullable();
            $table->datetime('activeby')->nullable();
            $table->datetime('activeto')->nullable();
            $table->datetime('realstart')->nullable();
            $table->datetime('realend')->nullable();
            $table->binary('logo')->nullable();
            $table->boolean('manual_voter_activation')->default(false);
            $table->dateTime('email_send-time')->nullable();
            $table->uuid('email_terminal')->nullable();
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
        Schema::dropIfExists('elections');
    }
}
