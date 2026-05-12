<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\FuelRecord;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin User ထည့်ခြင်း
        User::create([
            'name'     => 'Admin User',
            'email'    => 'admin@gmail.com',
            'password' => Hash::make('password123'), // bcrypt အစား Hash::make သုံးတာ ပို standard ဖြစ်ပါတယ်
        ]);

        // User များအတွက် Factory သုံးပြီး ၂၀ ထည့်ခြင်း
        \App\Models\User::factory(20)->create();

        // Fuel Records အခု ၂၀ ထည့်ခြင်း
        FuelRecord::factory(20)->create();
    }
}
