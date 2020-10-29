<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpidemiologyHospitalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('epidemiology_hospitals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_id')->constrained('tests');
            $table->date('start_at');
            $table->string('name');
            $table->boolean('icu')->default(false);
            $table->boolean('intubation')->default(false);
            $table->boolean('emco')->default(false);
            $table->string('status');
            $table->string('name_histories')->nullable();
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
        Schema::dropIfExists('epidemiology_hospitals');
    }
}
