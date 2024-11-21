<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         User::create([
            'name' =>  'daviNicolas',
            'email' => 'davi.oliveira102@aluno.ce.gov.br',
            'password' => bcrypt('12345678'),
         ]);
    }
}
