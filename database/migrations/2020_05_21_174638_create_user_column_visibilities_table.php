<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserColumnVisibilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_column_visibilities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('orphan_file_no')->nullable();
            $table->string('gender')->nullable();
            $table->string('orphan_birth_date')->nullable();
            $table->string('orphan_old_year')->nullable();
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
        Schema::dropIfExists('user_column_visibilities');
    }
}
