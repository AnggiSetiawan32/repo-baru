<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use  Illuminate\Support\Facades\DB;

class DummyUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'id' => '1111',
                'name'=>'Ary Kaprodi',
                'email'=>'arykaprodi@gmail.com',
                'role'=>'kaprodi',
                'password'=>bcrypt('123456')
            ],
            [
                'id' => '2222',
                'name'=>'Dody Dosen',
                'email'=>'dodydosen@gmail.com',
                'role'=>'dosen',
                'password'=>bcrypt('123456')
            ],
            [
                'id' => '3333',
                'name'=>'Dewi Dosen Wali',
                'email'=>'dewidosenwali@gmail.com',
                'role'=>'dosen_wali',
                'password'=>bcrypt('123456')
            ],
            [
                'id' => '4444',
                'name'=>'Dira Mahasiswa',
                'email'=>'diramahasiswa@gmail.com',
                'role'=>'mahasiswa',
                'password'=>bcrypt('123456')
            ],
        ];
        foreach ($userData as $key => $val){
            User::create($val);
        }
        
    }

    
}
