<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Note;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(\Database\Seeders\NoteSeeder::class);
    }
}
