<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Plugin\Multivendor\Models\IrecProjectTransaction;
use Plugin\Multivendor\Models\IrecProject;
use Core\Models\User;
use Carbon\Carbon;
use Faker\Factory as Faker;

class IrecProjectTransactionSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        
        // Set buyer_id to 1 for testing
        $buyerId = 1;
        
        // Get IREC projects
        $projects = IrecProject::take(10)->get();
        
        if ($projects->isEmpty()) {
            $this->command->info('Skipping IREC transaction seeder - no projects found');
            return;
        }

        $statuses = ['pending', 'completed', 'cancelled'];
        $transactions = [];

        // Create 15 transactions for buyer_id = 1
        $transactionCount = 15;
        
        for ($i = 0; $i < $transactionCount; $i++) {
            $project = $projects->random();
            $quantity = $faker->randomFloat(2, 0.5, 50); // 0.5 to 50 MWh
            $pricePerMwh = $faker->randomFloat(2, 15, 35); // EGP 15-35 per MWh
            $totalAmount = $quantity * $pricePerMwh;
            $status = $faker->randomElement($statuses);
            
            // Generate realistic dates - 80% in last 6 months, 20% older
            if ($faker->boolean(80)) {
                $transactionDate = $faker->dateTimeBetween('-6 months', 'now');
            } else {
                $transactionDate = $faker->dateTimeBetween('-2 years', '-6 months');
            }

            $transactions[] = [
                'project_id' => $project->id,
                'buyer_id' => $buyerId,
                'quantity_mwh' => $quantity,
                'price_per_mwh' => $pricePerMwh,
                'total_amount' => $totalAmount,
                'transaction_status' => $status,
                'transaction_date' => $transactionDate,
                'created_at' => $transactionDate,
                'updated_at' => $transactionDate,
            ];
        }

        // Batch insert for better performance
        foreach (array_chunk($transactions, 100) as $chunk) {
            IrecProjectTransaction::insert($chunk);
        }

        $this->command->info('Created ' . count($transactions) . ' IREC project transactions');
    }
}
