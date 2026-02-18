<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMissingColumnsToDoctorSchedules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('doctor_schedules', function (Blueprint $table) {
            $table->time('start_time')->nullable()->after('weekday');
            $table->time('end_time')->nullable()->after('start_time');
            $table->integer('avg_appointment_duration')->nullable()->after('end_time');
            $table->enum('serial_type', ['Social', 'Sequential'])->default('Sequential')->after('avg_appointment_duration');
            $table->integer('updated_by')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('doctor_schedules', function (Blueprint $table) {
            //
        });
    }
}
