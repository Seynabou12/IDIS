<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    public function run()
    {

        User::create([
            'prenom' => 'Seynabou',
            'nom' => 'Dione',
            'email' => 'dioneseynabou0@gmail.com',
            // 'photo' => '/images/news-3.jpg',
            'password' => Hash::make("password"),
            'profil' => 'superadmin'
            
        ]);

    }
}
