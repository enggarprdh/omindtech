<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('role')->insert([
            'id' => '1',
            'tenant_id' => 1,
            'code' => "SUP",
            'name' => "SUPERUSER",
            'isActive' => true,
            'updated_at' => null,
            'deleted_at' => null
        ]);
    }
}
