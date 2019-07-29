<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Privilege;
use App\Level;

class ProductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Grand Admin',
                'email' => 'admin@admin.com',
                'password' => 'adminadmin',
                'type' => 'ADMIN'
            ],
        ];

        foreach ($users as $user) {
            $u = User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
            ]);

            Privilege::create([
                'user_id' => $u->id,
                'type' => $user['type']
            ]);
        }

        $levels = [
            [
                'name' => 'Beginner',
                'exam_threshold' => 80,
                'evaluation_threshold' => 4
            ],
            [
                'name' => 'Intermediate I',
                'exam_threshold' => 80,
                'evaluation_threshold' => 2
            ],
            [
                'name' => 'Intermediate II',
                'exam_threshold' => 80,
                'evaluation_threshold' => 3
            ],
            [
                'name' => 'Advance',
                'exam_threshold' => 80,
                'evaluation_threshold' => 4
            ],
        ];

        foreach ($levels as $level) {
            Level::create([
                'name' => $level['name'],
            ]);
        }
    }
}
