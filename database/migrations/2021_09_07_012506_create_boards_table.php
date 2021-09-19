<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('board', function (Blueprint $table) {
            /*$table->increments('board_id');
            $table->string('board_name');
            $table->string('board_type');
            $table->string('board_nick');
            $table->enum('status', ['0', '1']);
            $table->dateTime('created_at', $precision = 0);*/

            $table->id();
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
        Schema::dropIfExists('tutorialpoint_board');
    }
}
