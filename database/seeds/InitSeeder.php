<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Privilege;
use App\Level;

class InitSeeder extends Seeder
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
            [
                'name' => 'Mukti Wibowo',
                'email' => 'mukti@mukti.com',
                'password' => 'muktimukti',
                'type' => 'USER'
            ],
            [
                'name' => 'Putra Witama',
                'email' => 'putra@putra.com',
                'password' => 'putraputra',
                'type' => 'USER'
            ],
            [
                'name' => 'Hamzah Rasyidi',
                'email' => 'hamzah@hamzah.com',
                'password' => 'hamzahhamzah',
                'type' => 'USER'
            ],
            [
                'name' => 'Taufik Hakim',
                'email' => 'hakim@hakim.com',
                'password' => 'hakimhakim',
                'type' => 'USER'
            ]
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
                'exam_threshold' => $level['exam_threshold'],
                'evaluation_threshold' => $level['evaluation_threshold'],
                'tujuan' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi consequat dictum lacus eget elementum. Pellentesque in lobortis sem, mattis volutpat nisl. Sed ac lacus id eros auctor eleifend. Donec sed erat quis nisl consequat hendrerit at nec purus. Nulla facilisi. Praesent maximus tellus id turpis porta tristique. Fusce interdum augue id malesuada luctus. Quisque ac scelerisque risus. Nullam ut tellus a quam varius malesuada id vitae tortor. Quisque ut ligula faucibus, dapibus risus sit amet, rutrum risus. Vivamus ultricies vestibulum nisi. Nulla consectetur metus aliquet molestie molestie. Etiam semper efficitur ullamcorper. Integer et ex vel lectus porttitor sollicitudin vitae ut dolor. Proin pharetra ante euismod rhoncus vestibulum.',
                'uraian' => 'Curabitur hendrerit suscipit ipsum, eu pharetra lorem gravida eget. Nulla sed neque justo. Phasellus efficitur, ligula quis bibendum tristique, diam purus porttitor sapien, eget venenatis mauris diam at mauris. Morbi vel felis at nisl ornare posuere nec aliquet diam. Vivamus pellentesque condimentum urna, vitae ornare tellus egestas nec. Donec consequat metus erat, in accumsan neque pretium vel. Curabitur a congue sapien.'
            ]);
        }
    }
}
