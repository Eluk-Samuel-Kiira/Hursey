<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SMTPSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        Setting::create([
            'app_name' => 'Hursey',
            'app_email' => 'info@hursey.co.ug',
            'app_contact' => '(+256) (0)392001682, +256 776104364',
        ]);
        
    }
}
