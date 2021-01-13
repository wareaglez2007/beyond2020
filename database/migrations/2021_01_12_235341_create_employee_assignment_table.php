<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeAssignmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_assignment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employees_id');
            $table->foreign('employees_id')->references('id')->on('employees')
            ->onDelete('cascade');
            $table->unsignedBigInteger('employee_roles_id');
            $table->foreign('employee_roles_id')->references('id')->on('employee_roles')
            ->onDelete('cascade');
            $table->unsignedBigInteger('groups_id');
            $table->foreign('groups_id')->references('id')->on('groups')
            ->onDelete('cascade');
            $table->unsignedBigInteger('devices_id');
            $table->foreign('devices_id')->references('id')->on('devices')
            ->onDelete('cascade');
            $table->unsignedBigInteger('applications_id');
            $table->foreign('applications_id')->references('id')->on('applications')
            ->onDelete('cascade');
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
        Schema::dropIfExists('employee_assignment');
    }
}
