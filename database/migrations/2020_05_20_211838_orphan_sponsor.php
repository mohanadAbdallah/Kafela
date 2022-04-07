<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OrphanSponsor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orphan_sponsor', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('orphan_id')->nullable();
            $table->unsignedBigInteger('sponsor_id')->nullable();
            $table->timestamps();

            $table->foreign('orphan_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('sponsor_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
