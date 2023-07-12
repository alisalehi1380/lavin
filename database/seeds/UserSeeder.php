<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Enums\genderType;
use App\Enums\Status;
 

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'fullname' => 'حمید یگانه دوست',
            'mobile' => '09116021103',
            'nationalcode' => '2580378138',
            'email' => 'hamid1ganeh@gmail.com',
            'gender'=> genderType::male,
            'password' => Hash::make('123456789'),
            'status' => Status::Active,
        ]);

        DB::table('admin_role')->insert([
            'admin_id' => 1,
            'role_id' => 1,
        ]);
    }
}
