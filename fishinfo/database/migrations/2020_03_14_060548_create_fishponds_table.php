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
            $table->string('fname')->nullable();
            $table->text('address')->nullable();
            $table->string('district')->nullable();
            $table->string('location_of_pond')->nullable();
            $table->string('tehsil')->nullable();
            $table->string('image')->nullable();
            $table->string('area')->nullable();
            $table->string('epic_no')->nullable();
            $table->string('name_of_scheme')->nullable();
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
