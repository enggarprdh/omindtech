<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user')->insert([
            'id' => '1',
            'tenant_id' => 1,
            'userName' => "easy-project@gmail.com",
            'password' => Hash::make("1234"),
            'firstName' => 'Easy',
            'lastName' => 'Admin',
            'isActive' => true,
            'updated_at' => null,
            'deleted_at' => null
        ]);
    }
}
