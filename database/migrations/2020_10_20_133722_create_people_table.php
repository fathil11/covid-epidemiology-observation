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
            $table->foreignId('user_id')->constrained('users'); // User creator
            $table->string('nik');
            $table->string('name');
            $table->string('phone');
            $table->enum('gender', ['m', 'f']);
            $table->string('parent_name');
            $table->string('card_path')->nullable();

            // Work & work place
            $table->string('work');
            $table->string('work_instance')->nullable();

            // Birthday & birth place
            $table->string('birth_regency');
            $table->date('birth_at');

            // ID Card Address
            $table->string('card_province');
            $table->string('card_regency');
            $table->string('card_district');
            $table->string('card_village');
            $table->string('card_street');
            $table->string('card_rt')->nullable();
            $table->string('card_rw')->nullable();

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
