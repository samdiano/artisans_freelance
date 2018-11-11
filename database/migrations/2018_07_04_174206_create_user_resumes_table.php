<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserResumesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_resumes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->longText('skills')->nullable();
            $table->string('minimum_salary')->nullable();
            $table->string('maximum_salary')->nullable();
            $table->string('institute')->nullable();
            $table->string('institute_duration')->nullable();
            $table->string('institute_qualification')->nullable();
            $table->longText('institute_notes')->nullable();

            $table->string('company_name')->nullable();
            $table->string('position')->nullable();
            $table->string('experience_duration')->nullable();
            $table->longText('experience_notes')->nullable();
            $table->binary('resume_description')->nullable();
            $table->longText('language')->nullable();

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
        Schema::dropIfExists('user_resumes');
    }
}
