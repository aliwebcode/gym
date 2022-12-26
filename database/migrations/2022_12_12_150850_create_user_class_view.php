<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserClassView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("
        create or replace view get_user_classes_view
        as
        SELECT
        cc.user_id ,cc.class_id ,cc.class_date , c.name_en , c.name_ar
        ,c.description_en ,c.description_ar ,c.image, c.duration
        from `customer_classes` cc , `gym_classes` c
        where c.id=cc.class_id
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_class_view');
    }
}
