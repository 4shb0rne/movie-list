<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovieActorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('movie_actors', function (Blueprint $table) {
            $table->foreignId('actor_id')->constrained()
                ->onDelete('cascade');
            $table->foreignId('movie_id')->constrained()
                ->onDelete('cascade');
            $table->string('character_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movie_actors');
    }
}
