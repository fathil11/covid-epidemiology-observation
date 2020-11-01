<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->uuid('code');
            $table->foreignId('user_id')->constrained('users'); // PE User
            $table->foreignId('person_id')->constrained('people');
            $table->string('test')->default('swab');
            $table->string('type')->default('nasofaring-orofaring');
            $table->string('criteria')->nullable();

            // Living Address
            $table->string('living_province');
            $table->string('living_regency');
            $table->string('living_district');
            $table->string('living_village');
            $table->string('living_street');
            $table->string('living_rt')->nullable();
            $table->string('living_rw')->nullable();

            $table->string('location')->default('internal');
            $table->string('tube_code')->nullable();
            $table->string('group_code')->nullable();

            $table->string('pe_path')->nullable();

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
        Schema::dropIfExists('tests');
    }
}
