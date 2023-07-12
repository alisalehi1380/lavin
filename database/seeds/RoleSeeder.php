<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'superadmin',
            'description' => 'مدیر اصلی کل سامانه',
        ]);


        DB::table('roles')->insert([
            'name' => 'doctor',
            'description' => 'پزشک',
        ]);
  
        DB::table('roles')->insert([
            'name' => 'secretary',
            'description' => 'منشی',
        ]);

        DB::table('roles')->insert([
            'name' => 'asistant1',
            'description' => 'دستیار اول',
        ]);

        DB::table('roles')->insert([
            'name' => 'asistant2',
            'description' => 'دستیار دوم',
        ]);
  
        DB::table('roles')->insert([
            'name' => 'reception',
            'description' => 'پذیرش',
        ]);

        foreach(Permission::all() as $permition)
        {
            DB::table('permission_role')->insert([
                'role_id' => 1,
                'permission_id' => $permition->id,
            ]);
        }
  
        
    }
}
