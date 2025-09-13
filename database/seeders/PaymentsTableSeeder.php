<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PaymentsTableSeeder extends Seeder
{
    public function run()
    {
        $userId = 9;
        $professionalId = 4;
        $amount = 2500.00;
        $adminCharge = 300.00;

        // Generate payments from January to November
        for ($month = 1; $month <= 11; $month++) {
            DB::table('payments')->insert([
                'user_id' => $userId,
                'professional_id' => $professionalId,
                'amount' => $amount,
                'admin_charge' => $adminCharge,
                'payment_date' => Carbon::create(2024, $month, 8)->format('Y-m-d'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
