<?php

namespace Database\Seeders;

use App\Models\Bid;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BidSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bids = [
            [
                'buyer_name' => 'Premier Farms',
                'tender_id' => 'TNDR-2025-001',
                'tender_title' => 'Supply of Maize (100 tons)',
                'category_id' => 1,
                'quantity'  => 100,
                'unit_price' => 2000,
                'amount' => 100 * 2000,
                'delivery_location' => 'Lagos',
                'delivery_date' => '2025-10-30',
                'note' => 'Reliable supplier, timely delivery guaranteed',
                'status' => 'Under Review',
            ],
            [
                'buyer_name' => 'FreshMart',
                'tender_id' => 'TNDR-2025-002',
                'tender_title' => 'Supply of Rice (50 tons)',
                'category_id' => 2,
                'quantity'  => 50,
                'unit_price' => 5000,
                'amount' => 50 * 5000,
                'delivery_location' => 'Abuja',
                'delivery_date' => '2025-11-05',
                'note' => 'Competitive pricing, includes transport',
                'status' => 'Accepted',
            ],
            [
                'buyer_name' => 'FoodCo',
                'tender_id' => 'TNDR-2025-003',
                'tender_title' => 'Vegetables for Supermarket Chain',
                'category_id' => 3,
                'quantity' => 200,
                'unit_price' => 1500,
                'amount' => 200 * 1500,
                'delivery_location' => 'Port Harcourt',
                'delivery_date' => '2025-11-12',
                'note' => 'Fresh vegetables directly from farm',
                'status' => 'Rejected',
            ],
        ];

        foreach ($bids as $bid) {
            Bid::create($bid);
        }
    }
}
