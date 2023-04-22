<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\File;
use App\Models\Note;

class Navigation extends Component
{
    public function render()
    {
        $notes = Note::all();
        return view('livewire.navigation', compact('notes'));
    }
}
