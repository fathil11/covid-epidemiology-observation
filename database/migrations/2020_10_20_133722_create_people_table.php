<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('nik');
            $table->string('name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->enum('gender', ['male', 'female']);
            $table->string('parent_name');
            $table->string('id_card_path')->nullable();

            // Work & work place
            $table->string('work');
            $table->string('work_position')->nullable();
            $table->string('work_location');

            // Birthday & birth place
            $table->date('birth_at');
            $table->foreignId('birth_regency_id')->constrained('regencies');

            // Living Address
            $table->foreignId('living_province_id')->constrained('provinces');
            $table->foreignId('living_regency_id')->constrained('regencies');
            $table->foreignId('living_district_id')->constrained('districts');
            $table->foreignId('living_village_id')->constrained('villages');
            $table->string('living_street');
            $table->string('living_rt');
            $table->string('living_rw');

            // ID Card Address
            $table->foreignId('card_province_id')->constrained('provinces');
            $table->foreignId('card_regency_id')->constrained('regencies');
            $table->foreignId('card_district_id')->constrained('districts');
            $table->foreignId('card_village_id')->constrained('villages');
            $table->string('card_street');
            $table->string('card_rt');
            $table->string('card_rw');

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
        Schema::dropIfExists('people');
    }
}
