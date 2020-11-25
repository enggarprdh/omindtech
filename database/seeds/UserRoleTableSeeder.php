<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 
        DB::table('user_role')->insert([
            'id' => '1',
            'user_id' => 1,
            'role_id' => 1,
            'isActive' => true,
            'updated_at' => null,
            'deleted_at' => null
        ]);
    }
}
