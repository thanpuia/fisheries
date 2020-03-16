<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFishpondsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fishponds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('district');
            $table->string('image');
            $table->string('pondImages')->nullable();

            $table->timestamps();
            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')
            ->references('id')
            ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fishponds');
    }
}
