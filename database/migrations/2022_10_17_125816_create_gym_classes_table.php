<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGymClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gym_classes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('training_id')->constrained()->cascadeOnDelete();
            $table->string('name_en');
            $table->string('name_ar');
            $table->text('description_en');
            $table->text('description_ar')->nullable();
            $table->string('image');
            $table->float('price', 10, 2)->default(0.00);
            $table->tinyInteger('duration')->default(60);
            $table->date('start_date')->default('1900-01-01');
            $table->date('end_date')->default('1900-01-01');
            $table->time('start_time')->default('00:00:00');
            $table->tinyInteger('capacity')->default(15);
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('gym_classes');
    }
}
