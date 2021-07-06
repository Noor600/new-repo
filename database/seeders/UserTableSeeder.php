<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = DB::table('users')->where('email', 'alnoooor5000@gmail.com')->first();

        if (! $user) {
          User::create([
            'name' => 'Mohammed Noor',
            'email' => 'alnoooor5000@gmail.com',
            'password' => Hash::make('0909665210'),
            'role' => 'admin'
          ]);
        }
    }
}
