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
        Schema::create('fixtures', function (Blueprint $table) {
            $table->unsignedInteger('id')->primary();
            $table->timestamps();
            $table->dateTime('date')->nullable();
            $table->unsignedInteger('home_team_id')->nullable();
            $table->foreign('home_team_id')->references('id')->on('teams')->onDelete('cascade');
            $table->unsignedInteger('away_team_id')->nullable();
            $table->foreign('away_team_id')->references('id')->on('teams')->onDelete('cascade');
            $table->unsignedBigInteger('venue_id')->nullable();
            $table->foreign('venue_id')->references('id')->on('venues')->onDelete('cascade');
            $table->string('stage')->nullable();
            $table->boolean('can_predict')->default(1);
            $table->tinyInteger('score_home')->nullable();
            $table->tinyInteger('score_away')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fixtures');
    }
};
