<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@tigf.or.tz'],
            [
                'name' => 'iscotz',
                'password' => Hash::make('Isoctz_2026_Secure@91'),
                'is_admin' => true,
            ]
        );

        $this->call(CmsPageSeeder::class);
        $this->call(TigfContentSeeder::class);
    }
}
