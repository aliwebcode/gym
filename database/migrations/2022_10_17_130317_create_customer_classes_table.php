<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_classes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('class_id')->constrained('gym_classes')->cascadeOnDelete();
            $table->foreignId('cart_item_id')->constrained('cart_items')->cascadeOnDelete();
            $table->dateTime('class_date')->default(' 1900-01-01 00:00:00');
            $table->float('payment', 3, 2)->default(0.00);
            $table->tinyInteger('has_subscription')->default(0);
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
        Schema::dropIfExists('customer_classes');
    }
}
