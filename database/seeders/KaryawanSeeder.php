<?php

namespace Database\Seeders;


 
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // data faker indonesia
         $faker = Faker::create('id');
 
         // membuat data dummy sebanyak 10 record
         for($x = 1; $x <= 10; $x++){

             // insert data dummy kedalam table karyawan
             DB::table('karyawans')->insert([
                 'nama' => $faker->name,
                 'jabatan' => $faker->jobTitle,
                 'status' => $faker->randomElement(['PNS', 'Honorer']),
                 'email' => $faker->email,
                 'no_hp' => $faker->phoneNumber
             ]);
         }
    }
}