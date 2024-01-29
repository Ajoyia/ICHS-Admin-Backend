<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        if(empty(User::where('email','admin@ichs.uk')->first()))
        {
            User::insert([
                'first_name' => Str::random(10),
                'email' => 'admin@ichs.uk',
                'password' => Hash::make('password'),
                'created_at'=>date("Y-m-d H:i:s"),
                'updated_at'=>date("Y-m-d H:i:s")
            ]);
        }
    }
}
// Test
