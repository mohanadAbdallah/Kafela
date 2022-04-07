<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('orphan_file_no')->nullable();
            $table->string('gender')->nullable();
            $table->date('orphan_birth_date')->nullable();
            $table->integer('orphan_old_year')->nullable();
            $table->string('orphan_country')->nullable();
            $table->string('orphan_identity')->nullable();
            $table->string('orphan_age_range')->nullable();
            $table->string('orphan_study_range')->nullable();
            $table->string('orphan_school_name')->nullable();
            $table->string('orphan_study_year')->nullable();
            $table->string('orphan_health_state')->nullable();
            $table->string('orphan_disease_name')->nullable();
            $table->string('orphan_disease_type')->nullable();


            $table->string('mother_file_no')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_phone')->nullable();
            $table->string('mother_identity')->nullable();
            $table->string('mother_iban')->nullable();
            $table->string('mother_salary')->nullable();

            $table->string('sponsor_file_no')->nullable();
            $table->string('ensure_type')->nullable();
            $table->integer('orphans_count')->nullable();
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
