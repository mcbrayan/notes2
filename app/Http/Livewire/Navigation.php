<?php

namespace App\Http\Livewire;

use Livewire\WithPagination;

use Livewire\Component;

use App\Models\File;
use App\Models\Note;

class Navigation extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";

    public function render()
    {
        $notes = Note::where('user_id', auth()->user()->id)
            ->where('title', 'LIKE', '%' . $this->search . '%')
            ->latest('id')
            ->paginate(10);
        return view('livewire.admin.', compact('notes'));
    }
}
