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
            $table->foreignId('test_id')->constrained('tests');
            $table->string('type'); // International/Domestic/Living
            $table->string('country')->default('Indonesia');
            $table->string('province')->nullable();
            $table->string('regency')->nullable();
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
