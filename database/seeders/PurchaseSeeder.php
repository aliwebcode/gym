<?php

namespace Database\Seeders;

use App\Models\PurchaseType;
use Illuminate\Database\Seeder;

class PurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PurchaseType::create([
            'name_en' => 'Class',
            'name_ar' => 'كلاس'
        ]);
        PurchaseType::create([
            'name_en' => 'Subscription',
            'name_ar' => 'اشتراك'
        ]);
        PurchaseType::create([
            'name_en' => 'Product',
            'name_ar' => 'منتج'
        ]);
    }
}
