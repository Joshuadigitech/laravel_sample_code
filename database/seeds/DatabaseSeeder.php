<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('roles')->insert([
            'name' => 'client',
        ]);
        DB::table('roles')->insert([
            'name' => 'CM',
        ]);
        DB::table('roles')->insert([
            'name' => 'HR',
        ]);
        DB::table('roles')->insert([
            'name' => 'director',
        ]);

        //Services table Seeding
        DB::table('services')->insert([
            'name' => 'Ad Hoc',
        ]);
        DB::table('services')->insert([
            'name' => 'Part Time',
        ]);
        DB::table('services')->insert([
            'name' => 'Full Time',
        ]);
        //User Table
        DB::table('users')->insert([
            'first_name' => 'zee',
            'last_name' => 'HR',
            'email' => 'zee@hr.com',
            'password' => bcrypt('12345678'),
            'gender' => 'male',
            'role_id' => '3',
            'phone' => '123456789',
            'is_approved' => '1',
            'exp_level'=>'0',
            'joining_date'=>date("Y-m-d")
        ]);
        DB::table('users')->insert([
            'first_name' => 'zee',
            'last_name' => 'admin',
            'email' => 'zee@admin.com',
            'password' => bcrypt('12345678'),
            'gender' => 'male',
            'role_id' => '4',
            'phone' => '123456789',
            'is_approved' => '1',
            'exp_level'=>'0',            
            'joining_date' =>date("Y-m-d")
        ]);
          DB::table('users')->insert([
            'first_name' => 'zee',
            'last_name' => 'CM',
            'email' => 'zee@cm.com',
            'password' => bcrypt('12345678'),
            'gender' => 'male',
            'role_id' => '2',
            'phone' => '123456789',
            'is_approved' => '1',
            'exp_level'=>'2',
            'joining_date'=>date("Y-m-d")
        ]);

        //Exp Level
          DB::table('exp_level')->insert([
            'name'=> 'less then 1 year',
            
        ]);
        DB::table('exp_level')->insert([
            'name'=> '1~2 year',
            
        ]);
        DB::table('exp_level')->insert([
            'name'=> '2~3 year',
            
        ]);
        DB::table('exp_level')->insert([
            'name'=> '3+ year',
            
        ]);

        //Pricing table seeding
        DB::table('pricing')->insert([
            'exp_level_id'=> '1',
            'price'=> '10',
            'start_date'=> date("Y-m-d")
        ]);
        DB::table('pricing')->insert([
            'exp_level_id'=> '2',
            'price'=> '20',
            'start_date'=> date("Y-m-d")
        ]);
        DB::table('pricing')->insert([
            'exp_level_id'=> '3',
            'price'=> '30',
            'start_date'=> date("Y-m-d")
        ]);
        DB::table('pricing')->insert([
            'exp_level_id'=> '4',
            'price'=> '40',
            'start_date'=> date("Y-m-d")
        ]);

    }
}
