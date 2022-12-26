<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSubscriptionView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("
        create or replace view get_user_subscriptions_view
        as
        select
        cs.user_id ,cs.`subscrib_id` , cs.`status_id`,cs.`start_date`,cs.`end_date`, s.name_en , s.name_ar
        from `customer_subscriptions` cs , `subscriptions` s
        where s.id=cs.`subscrib_id`
        and UTC_DATE() between cs.`start_date` and cs.`end_date`
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_subscription_view');
    }
}
