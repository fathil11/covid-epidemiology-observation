<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpidemiologyTravelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('epidemiology_travel', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->foreignId('country_id')->nullable()->constrained('countries');
            $table->foreignId('province_id')->constrained('provinces');
            $table->foreignId('regency_id')->constrained('regencies');
            $table->foreignId('district_id')->constrained('districts');
            $table->foreignId('village_id')->constrained('villages');
            $table->date('departure_at');
            $table->date('arrive_at');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('epidemiology_travel');
    }
}
