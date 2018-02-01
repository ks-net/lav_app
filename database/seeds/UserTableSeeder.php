<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $role_admin = Role::where('name', 'admin')->first();
        $role_manager = Role::where('name', 'manager')->first();
        $role_editor = Role::where('name', 'editor')->first();
        $role_registered = Role::where('name', 'registered')->first();

        /*
         * ADMIN
         */
        DB::table('users')->insert([
            'name' => 'webmaster',
            'email' => 'stathopoulos.kostas@gmail.com',
            'password' => '$2a$04$mc1QSjkylbfMRinwOMk37OyHshW9OPgfrNjUX.PIhBTZwcPZl5d/2', // Bcrypt hash string for pass=>  1234
        ]);

        $admin = User::where('id', 1)->first();
        $admin->roles()->attach($role_admin);

        /*
         * MANAGER
         */
        DB::table('users')->insert([
            'name' => 'manager',
            'email' => 'info@ks-net.gr',
            'password' => '$2a$04$mc1QSjkylbfMRinwOMk37OyHshW9OPgfrNjUX.PIhBTZwcPZl5d/2', // Bcrypt hash string for pass=>  1234
        ]);

        $manager = User::where('id', 2)->first();
        $manager->roles()->attach($role_manager);

        /*
         * EDITOR
         */
        DB::table('users')->insert([
            'name' => 'editor',
            'email' => 'info@stathopoulos.org',
            'password' => '$2a$04$mc1QSjkylbfMRinwOMk37OyHshW9OPgfrNjUX.PIhBTZwcPZl5d/2', // Bcrypt hash string for pass=>  1234
        ]);

        $editor = User::where('id', 3)->first();
        $editor->roles()->attach($role_editor);

        /*
         * REGISTERED USER
         */
        DB::table('users')->insert([
            'name' => 'registered',
            'email' => 'info@palaiopyrgos.gr',
            'password' => '$2a$04$mc1QSjkylbfMRinwOMk37OyHshW9OPgfrNjUX.PIhBTZwcPZl5d/2', // Bcrypt hash string for pass=>  1234
        ]);

        $registered = User::where('id', 4)->first();
        $registered->roles()->attach($role_registered);

    }

}
