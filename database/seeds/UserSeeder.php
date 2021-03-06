<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Gerut',
            'email' => 'admin@dinkesmelawi.com',
            'phone' => '082225210125',
            'instance' => 'Lab Kesda',
            'instance_place' => 'Nanga Pinoh',
            'password' => Hash::make('gerutganteng'),
            'role' => '1'
        ]);

        User::create([
            'name' => 'dr. Gunadi',
            'email' => 'lab@dinkesmelawi.com',
            'phone' => '082225210125',
            'instance' => 'Lab Kesda',
            'instance_place' => 'Nanga Pinoh',
            'password' => Hash::make('labkesdajaya'),
            'role' => '2'
        ]);

        //! PE Account
        User::create([
            'name' => 'Heri Dermawan',
            'email' => 'heri.dermawan@dinkesmelawi.com',
            'phone' => '085389104041',
            'instance' => 'Dinas Kesehatan',
            'instance_place' => 'Melawi',
            'password' => Hash::make('gisellehot'),
            'role' => '3'
        ]);

        User::create([
            'name' => 'Terissia',
            'email' => 'terissia@dinkesmelawi.com',
            'phone' => '081256824870',
            'instance' => 'Dinas Kesehatan',
            'instance_place' => 'Melawi',
            'password' => Hash::make('istrijenderal'),
            'role' => '3'
        ]);

        User::create([
            'name' => 'Faulina Intan',
            'email' => 'faulina.intan@dinkesmelawi.com',
            'phone' => '081356767487',
            'instance' => 'Dinas Kesehatan',
            'instance_place' => 'Melawi',
            'password' => Hash::make('intancantik'),
            'role' => '3'
        ]);

        User::create([
            'name' => 'Paulina Saragi',
            'email' => 'paulina.saragi@dinkesmelawi.com',
            'phone' => '082351404027',
            'instance' => 'Dinas Kesehatan',
            'instance_place' => 'Melawi',
            'password' => Hash::make('realmeRM'),
            'role' => '3'
        ]);

        User::create([
            'name' => 'Anita Cristina',
            'email' => 'anita.cristina@dinkesmelawi.com',
            'phone' => '081345200405',
            'instance' => 'Dinas Kesehatan',
            'instance_place' => 'Melawi',
            'password' => Hash::make('myharuto'),
            'role' => '3'
        ]);

        User::create([
            'name' => 'Devi Puspasari',
            'email' => 'devi.puspasari@dinkesmelawi.com',
            'phone' => '085348361761',
            'instance' => 'Dinas Kesehatan',
            'instance_place' => 'Melawi',
            'password' => Hash::make('dps1234'),
            'role' => '3'
        ]);

        User::create([
            'name' => 'Beatriks Halla',
            'email' => 'beatriks.halla@dinkesmelawi.com',
            'phone' => '082252145050',
            'instance' => 'Dinas Kesehatan',
            'instance_place' => 'Melawi',
            'password' => Hash::make('rsud1234'),
            'role' => '3'
        ]);

        User::create([
            'name' => 'Agnes',
            'email' => 'agnes@dinkesmelawi.com',
            'phone' => '081251417455',
            'instance' => 'Dinas Kesehatan',
            'instance_place' => 'Melawi',
            'password' => Hash::make('pkm1234'),
            'role' => '3'
        ]);

        User::create([
            'name' => 'Bambang Eko T.',
            'email' => 'bambang.eko@dinkesmelawi.com',
            'phone' => '081270522847',
            'instance' => 'Dinas Kesehatan',
            'instance_place' => 'Melawi',
            'password' => Hash::make('19detikkurang'),
            'role' => '3'
        ]);

        User::create([
            'name' => 'Hendrika Ratnasari',
            'email' => 'hendrika.ratnasari@dinkesmelawi.com',
            'phone' => '089669041680',
            'instance' => 'Dinas Kesehatan',
            'instance_place' => 'Melawi',
            'password' => Hash::make('kch1234'),
            'role' => '3'
        ]);


        //! STATISTIC USER
        User::create([
            'name' => 'dr. Ahmad Jawahir',
            'email' => 'ahmad.jawahir@dinkesmelawi.com',
            'phone' => '085768574456',
            'instance' => 'Dinas Kesehatan',
            'instance_place' => 'Melawi',
            'password' => Hash::make('aj250568'),
            'role' => '5'
        ]);

        User::create([
            'name' => 'dr.Gunadi Linoh',
            'email' => 'gunadi.linoh@dinkesmelawi.com',
            'phone' => '085768574456',
            'instance' => 'Dinas Kesehatan',
            'instance_place' => 'Melawi',
            'password' => Hash::make('tanyapakgunjak'),
            'role' => '5'
        ]);

        User::create([
            'name' => 'dr. Tanjung Harapan',
            'email' => 'tanjung.harapan@dinkesmelawi.com',
            'phone' => '085768574456',
            'instance' => 'Dinas Kesehatan',
            'instance_place' => 'Melawi',
            'password' => Hash::make('tanyapakgunjak'),
            'role' => '5'
        ]);

        User::create([
            'name' => 'Indriani Darmowiyoto',
            'email' => 'indirani.darmowiyoto@dinkesmelawi.com',
            'phone' => '085768574456',
            'instance' => 'Dinas Kesehatan',
            'instance_place' => 'Melawi',
            'password' => Hash::make('tanyapakgunjak'),
            'role' => '5'
        ]);

        User::create([
            'name' => 'Endang Susilawati',
            'email' => 'endang.susilawati@dinkesmelawi.com',
            'phone' => '085768574456',
            'instance' => 'Dinas Kesehatan',
            'instance_place' => 'Melawi',
            'password' => Hash::make('tanyapakgunjak'),
            'role' => '5'
        ]);

        User::create([
            'name' => 'Bambang Triswanto',
            'email' => 'bambang.triswanto@dinkesmelawi.com',
            'phone' => '085768574456',
            'instance' => 'Dinas Kesehatan',
            'instance_place' => 'Melawi',
            'password' => Hash::make('tanyapakgunjak'),
            'role' => '5'
        ]);


    }
}
