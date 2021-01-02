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
            $table->text('name');
            $table->text('description');
            $table->boolean('abstention');
            $table->boolean('statistics');
            $table->text('status');
            $table->text('uuid');
            $table->text('type');
            $table->integer('permission_id')->nullable();
            $table->text('activeby')->nullable();
            $table->text('activeto')->nullable();
            $table->text('realstart')->nullable();
            $table->text('realend')->nullable();
            $table->text('logo')->nullable();
            $table->boolean('manual_voter_activation')->default(false);
            $table->text('email_sendtime')->nullable();
            $table->text('email_terminal')->nullable();
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
