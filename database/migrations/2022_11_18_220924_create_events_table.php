<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->integer('fixture_id')->unsigned()->index();
            $table->foreign('fixture_id')->references('id')->on('fixtures')->onDelete('cascade');

            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');

            $table->string('type')->nullable();

            $table->string('time_elapsed')->nullable();
            $table->string('time_extra')->nullable();

            $table->unsignedInteger('player_id')->nullable();
            $table->string('player_name')->nullable();

            $table->unsignedInteger('assist_id')->nullable();
            $table->string('assist_name')->nullable();

            $table->string('detail')->nullable();
            $table->string('comments')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
};
