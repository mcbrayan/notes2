<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\File;

class Navigation extends Component
{
    public function render()
    {
        $files = File::all();
        return view('livewire.navigation', compact('files'));
    }
}
