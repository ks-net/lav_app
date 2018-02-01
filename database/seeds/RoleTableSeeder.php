<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $roles = [
            ['name' => 'admin', 'description' => 'admin role'],
            ['name' => 'manager', 'description' => 'manager role'],
            ['name' => 'editor', 'description' => 'editor role'],
            ['name' => 'registered', 'description' => 'registered user role']
        ];

        DB::table('roles')->insert($roles);
    }

}
