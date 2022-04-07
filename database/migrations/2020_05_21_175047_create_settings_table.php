<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('message_monthly_pay')->nullable();
            $table->text('message_yearly_pay')->nullable();
            $table->text('message_by_month_pay')->nullable();
            $table->text('message_thanks_sponsor')->nullable();
            $table->text('message_orphan_received')->nullable();
            $table->integer('name_characters_count')->nullable();
            $table->string('date_send_messages')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
