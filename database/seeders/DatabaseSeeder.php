<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Superadmin LexaLink',
            'email' => 'superadmin@lexalink.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'superadmin',
            'whatsapp' => '081111111111'
        ]);

        \App\Models\User::create([
            'name' => 'Admin Staff',
            'email' => 'admin@lexalink.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'admin',
            'whatsapp' => '082222222222'
        ]);

        \App\Models\User::create([
            'name' => 'Client Demo',
            'email' => 'client@example.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'client',
            'whatsapp' => '083333333333'
        ]);

        \App\Models\Service::create([
            'id' => 1,
            'name' => 'Pembuatan NIB & Sertifikat Halal',
            'category' => 'Perizinan',
            'short_description' => 'Paket lengkap perizinan usaha UMKM.',
            'base_price' => 500000
        ]);

        \App\Models\Service::create([
            'id' => 2,
            'name' => 'Penyusunan Perjanjian Kerjasama (MoU)',
            'category' => 'Legal Drafting',
            'short_description' => 'Drafting kontrak bisnis profesional.',
            'base_price' => 1500000
        ]);

        $this->call([
            ArticleSeeder::class,
            EventSeeder::class,
            LegalResourceSeeder::class,
        ]);
    }
}
