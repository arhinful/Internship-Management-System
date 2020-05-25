<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('second_name');
            $table->string('other_name')->nullable();
            $table->string('course')->nullable();
            $table->string('level')->nullable();
            $table->string('email')->nullable()->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('attachment_start')->nullable();
            $table->timestamp('attachment_end')->nullable();
            $table->integer('score')->nullable();
            $table->string('attachment_company')->nullable();
            $table->string('password')->default(bcrypt('0000'));
            $table->integer('index_number')->unique();
            $table->bigInteger('company_id')->unsigned()->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('students');
    }
}
