<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProductView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("
        create or replace view products_of_user_view
        as
        select c.user_id as user_id,
               p.name_en,
               p.name_ar,
               p.description_en,
               p.description_ar,
               p.image,
               ci.payment,
               ci.created_at
        from carts c , cart_items ci,`purchase_types` pt,products p
        where c.id=ci.cart_id
        and   pt.id=ci.item_type_id
        and   p.id=ci.item_id
        and   pt.id=3
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_product_view');
    }
}
