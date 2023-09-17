<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class ConnectRelationshipsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Get Available Permissions.
         */
        $permissions = config('roles.models.permission')::all();

        /**
         * Attach Permissions to Roles.
         */
        $roleAdmin = config('roles.models.role')::where('name', '=', 'Admin')->first();
        foreach ($permissions as $permission) {
            $roleAdmin->attachPermission($permission);
        }
        $roleStudent = config('roles.models.role')::where('name', '=', 'Student')->first();
        $roleInstructor = config('roles.models.role')::where('name', '=', 'Instructor')->first();


        $userAdmin = User::where('email','admin@admin.com')->first();
        $userAdmin->attachRole($roleAdmin);
    }
}
