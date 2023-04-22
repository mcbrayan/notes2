<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Note;
use Illuminate\Support\Facades\Hash;

class NoteSeeder extends Seeder
{

    public function run(): void
    {
        Note::factory(50)->create();
    }
}
