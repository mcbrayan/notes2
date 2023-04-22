<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Storage::deleteDirectory('images');
        Storage::makeDirectory('images');

        User::factory()->create([
            'name' => 'Brayan sierra',
            'email' => 'sbrayandres@gmail.com',
            'password' => Hash::make('292071'),
        ]);

        $this->call(NoteSeeder::class);
        $this->call(FileSeeder::class);
    }
}
