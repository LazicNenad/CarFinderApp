<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('car_mark_id')->constrained();
            $table->foreignId('car_model_id')->constrained();
            $table->foreignId('car_type_id')->constrained();
            $table->foreignId('gas_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('drivetrain_id')->constrained();
            $table->string('description');
            $table->string('year');
            $table->string('new');
            $table->string('transmission');
            $table->string('mileage');
            $table->string('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
};
