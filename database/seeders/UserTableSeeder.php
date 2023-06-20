<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'email' => 'admin@gmail.com',
                'password' => '$2y$10$IapBfCW0El7WCAD9hdUoBuKNBrFUyAkj9mYUM49JM7t/Zx2PWcPSm', //admin@12345
                'first_name' => 'Admin',
                'last_name' => 'admin',
                'mobile_number' => '0711515155',
                'role_id' => '1',
                'created_at' => '2023-06-19',
                'updated_at' => '2023-06-19',
                'deleted_at' => null,
            ]
        ]);
    }
}
