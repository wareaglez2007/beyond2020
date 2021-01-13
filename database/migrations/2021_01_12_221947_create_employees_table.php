<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('seid')->unique();
            $table->string('name');
            $table->string('m_name')->nullable();
            $table->string('l_name');
            $table->string('email')->unique();
            $table->string('work_number')->nullable();
            $table->string('office');
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->string('start_date');
            $table->boolean('active')->default(0);
            $table->enum('telework', ['frequent', 'adhoc','fulltime','not allowed'])->default('not allowed');
            $table->softDeletes();
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
        Schema::dropIfExists('employees');
    }
}
