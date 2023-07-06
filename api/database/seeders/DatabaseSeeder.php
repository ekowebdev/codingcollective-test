<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Seeder;
use Database\Seeders\WalletSeeder;
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
        if(count(User::all()) == 0) {
            $user = User::create([
                'name' => 'Eko Prasetyo',
                'email' => 'eko@mail.com',
                'password' => Hash::make('123456')
            ]);

            Wallet::create([
                'user_id' => $user->id,
                'balance' => 500000.00
            ]);
        }
    }
}
