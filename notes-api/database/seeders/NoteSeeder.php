<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Note;

class NoteSeeder extends Seeder
{
    public function run(): void
    {
        // Option A: create() uses $fillable on the model
        Note::create(['title' => 'Welcome', 'content' => 'This is your first note.']);
        Note::create(['title' => 'Second',  'content' => 'Edit or delete me.']);

        // Option B (alternative): insert() with timestamps
        // Note::insert([
        //     ['title'=>'Welcome','content'=>'This is your first note.','created_at'=>now(),'updated_at'=>now()],
        //     ['title'=>'Second','content'=>'Edit or delete me.','created_at'=>now(),'updated_at'=>now()],
        // ]);
    }
}
