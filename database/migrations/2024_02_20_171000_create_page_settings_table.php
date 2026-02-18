<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('page_settings')) {
            Schema::create('page_settings', function (Blueprint $table) {
                $table->id();
                $table->string('page_name')->unique(); // e.g., 'prescription_show'
                $table->json('settings');             // e.g., {"show_header": true, "margin_top": 10}
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page_settings');
    }
}
