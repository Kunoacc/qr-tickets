<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('data_id');
            $table->timestamps();
        });

        Schema::table('attendees', function (Blueprint $table){
           $table->foreign('data_id')->references('id')->on('data');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attendees', function (Blueprint $table){
           $table->dropForeign('attendees_data_id_foreign');
        });
        Schema::dropIfExists('attendees');
    }
}
