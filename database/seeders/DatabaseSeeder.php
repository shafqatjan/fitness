<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Models\User::create([
            "name" => "Shafqat",
            "email" => "shafqatjan86@gmail.com",
            'password' => Hash::make('Shafqat123'),
            'email_verified_at' => Carbon::now(),
        ]);
        $userSteps = \App\Models\Usersteps::create([
            "user_id" => $user->id,
            "steps" => 1001,
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addHour(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
