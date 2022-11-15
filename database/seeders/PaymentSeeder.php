<?php

namespace Database\Seeders;

use App\Models\PaymentType;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentType::create([
            'name_en' => 'Cash',
            'name_ar' => 'كاش'
        ]);
        PaymentType::create([
            'name_en' => 'Visa',
            'name_ar' => 'فيزا'
        ]);
    }
}
