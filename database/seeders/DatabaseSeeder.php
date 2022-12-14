<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Data User 
        DB::table('user')->insert([
            [
                'id'=>'1',
                'username'=>'admin',
                'email'=>'laravel@email.com',
                'password'=>Hash::make('1234'),
                'role_id'=>'1'
            ],
            [
                'id'=>'2',
                'username'=>'user',
                'email'=>'user@email.com',
                'password'=>Hash::make('1234'),
                'role_id'=>'2'
            ]
        ]);

        //Data Role
        DB::table('role')->insert([
            ['id'=>'1','role'=>'Superadmin','deskripsi'=>'Memiliki semua hak akses'],
            ['id'=>'2','role'=>'Staf Keuangan','deskripsi'=>'Memiliki hak akses tertentu (keuangan saja)']
        ]);

        //Data Info Fitur
        DB::table('fitur')->insert([
            ['id'=>'1','fitur'=>'create'],
            ['id'=>'2','fitur'=>'read'],
            ['id'=>'3','fitur'=>'update'],
            ['id'=>'4','fitur'=>'delete'],
        ]);

        //Data Hak Akses Pada Role
        DB::table('akses')->insert([
            //Role Superadmin
            ['role_id'=>'1','akses'=>'create','semua'=>'1'],
            ['role_id'=>'1','akses'=>'read','semua'=>'1'],
            ['role_id'=>'1','akses'=>'update','semua'=>'1'],
            ['role_id'=>'1','akses'=>'delete','semua'=>'1'],
            
            //Role Staf Keuangan
            ['role_id'=>'2','akses'=>'create','semua'=>'1'],
            ['role_id'=>'2','akses'=>'read','semua'=>'0'],
            ['role_id'=>'2','akses'=>'update','semua'=>'0'],
        ]);

        //Data Kategori Biaya
        DB::table('kategori_biaya')->insert([
            //Role Superadmin
            ['id'=>'1','nama'=>'Contoh SuperAdmin','deskripsi'=>'Data ini dibuat oleh user SuperAdmin','user_id'=>'1'],
            ['id'=>'2','nama'=>'Contoh Staf Keuangan','deskripsi'=>'Data ini dibuat oleh user Staff Keuangan','user_id'=>'2']
        ]);
    }
}
