<?php

use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('role_user')->truncate();

        $administ= User::create([
            'first_name' => 'Admin',
            'last_name' => 'instant',
            'email' => 'admin@gmail.com',
            'headline' => 'Web Developer',
            'image' => 'https://image.flaticon.com/icons/svg/21/21104.svg',
            'about' => "I'm a Web Developer",
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('password')
        ]);
        $teacher= User::create([
            'first_name' => 'Teacher',
            'last_name' => 'instant',
            'headline' => 'Content Maker',
            'image' => 'https://image.flaticon.com/icons/svg/21/21104.svg',
            'about' => "I'm a Content Creator",
            'email' => 'teacher@gmail.com',
            'country' => 'Mauritania',
            'city' => 'Nouakchott',
            'languages' => 'English, French',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('password')
        ]);
        $student= User::create([
            'first_name' => 'Student',
            'last_name' => 'instant',
            'headline' => 'Student',
            'image' => 'https://image.flaticon.com/icons/svg/21/21104.svg',
            'email' => 'student@gmail.com',
            'about' => "I'm a Student",
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('password')
        ]);
        $administR = Role::where('name', 'admin')->first();
        $teacherR = Role::where('name', 'teacher')->first();
        $studentR = Role::where('name', 'student')->first();


        $administ->roles()->attach($administR);
        $teacher->roles()->attach($teacherR);
        $student->roles()->attach($studentR);
    }
}
