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
            $table->string('nik')->nullable();
            $table->string('name');
            $table->string('phone')->nullable();
            $table->enum('gender', ['m', 'f']);
            $table->string('parent_name')->nullable();
            $table->string('card_path')->nullable();

            // Work & work place
            $table->string('work')->nullable();
            $table->string('work_instance')->nullable();

            // Birthday & birth place
            $table->string('birth_regency')->nullable();
            $table->date('birth_at')->nullable();

            // ID Card Address
            $table->string('card_province')->nullable();
            $table->string('card_regency')->nullable();
            $table->string('card_district')->nullable();
            $table->string('card_village')->nullable();
            $table->string('card_street')->nullable();
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
