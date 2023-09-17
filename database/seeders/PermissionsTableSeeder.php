<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = array(
             'users', 'roles', 'courses' , 'enrollments'
        );

        $actions = array('index', 'create', 'update', 'show', 'store', 'edit', 'destroy', 'status');
        $titles = array(
            'index' => 'View',
            'create' => 'Create',
            'update' => 'Update',
            'store' => 'Store',
            'edit' => 'Edit',
            'destroy' => 'Delete',
            'show' => 'View Detail',
            'status' => 'Manage Status'
        );
        $array = array();
        foreach ($permissions as $key => $p) {
            foreach ($actions as $k => $action) {
                $slug = ''.Str::lower($p).'.'.$action;
                if (!(config('roles.models.permission')::where('slug', '=', $slug)->first())) {
                    $data = [
                        'name' => 'Can ' . Str::title($titles[$action]) . ' ' . Str::title($p),
                        'slug' => $slug,
                        'model' => 'Permission',
                        'description' => 'Can ' . Str::title($titles[$action]) . ' ' . Str::title($p)
                    ];
                    $array[] = $data;
                }
            }
        }
        DB::table('permissions')->insert($array);
    }
}
