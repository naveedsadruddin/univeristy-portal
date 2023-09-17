<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userRole = config('roles.models.role')::where('name', '=', 'User')->first();
        $adminRole = config('roles.models.role')::where('name', '=', 'Admin')->first();
        $studentRole = config('roles.models.role')::where('name', '=', 'Student')->first();
        $instructorRole = config('roles.models.role')::where('name', '=', 'Instructor')->first();


        $permissions = config('roles.models.permission')::all();

        /*
         * Add Users
         *
         */
        if (config('roles.models.defaultUser')::where('email', '=', 'admin@admin.com')->first() === null) {
            $newUser = config('roles.models.defaultUser')::create([
                'name'     => 'Admin',
                'email'    => 'admin@admin.com',
                'password' => bcrypt('password'),
                'status' => 1,
            ]);

            $newUser->attachRole($adminRole);
            foreach ($permissions as $permission) {
                $newUser->attachPermission($permission);
            }
        }

        if (config('roles.models.defaultUser')::where('email', '=', 'user@user.com')->first() === null) {
            $newUser = config('roles.models.defaultUser')::create([
                'name'     => 'User',
                'email'    => 'user@user.com',
                'password' => bcrypt('password'),
                'status' => 1,

            ]);

            $newUser->attachRole($userRole);
        }
        if (config('roles.models.defaultUser')::where('email', '=', 'student@student.com')->first() === null) {
        $newUser1 = config('roles.models.defaultUser')::create([
            'name'     => 'student',
            'email'    => 'student@student.com',
            'password' => bcrypt('password'),
            'status' => 1,
        ]);
        $newUser1->attachRole($studentRole);
    }
    if (config('roles.models.defaultUser')::where('email', '=', 'instructor@instructor.com')->first() === null) {
        $newUser2 = config('roles.models.defaultUser')::create([
            'name'     => 'instructor',
            'email'    => 'instructor@instructor.com',
            'password' => bcrypt('password'),
            'status' => 1,
        ]);
        $newUser2->attachRole($instructorRole);
    }
        $userAdmin = User::where('email','admin@admin.com')->first();
        $userAdmin->attachRole($adminRole);
    }
}
