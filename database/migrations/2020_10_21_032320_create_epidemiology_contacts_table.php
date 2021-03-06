<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpidemiologyContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('epidemiology_contacts', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // Normal, Close
            $table->foreignId('test_id')->constrained('tests');
            $table->string('name');
            $table->enum('gender', ['m', 'f']);
            $table->string('address'); // Not proccessed attribute
            $table->string('phone')->nullable();
            $table->string('status');
            $table->date('start_at');
            $table->date('end_at');
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
        Schema::dropIfExists('epidemiology_contacts');
    }
}
