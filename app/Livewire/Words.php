<?php

namespace App\Livewire;

use App\Models\Word;
use Livewire\Component;

class Words extends Component
{
    public $words;
    public $meaningVisible = false;
    public $selectedWordId;

    public function showMeaning($wordId)
    {
        $this->selectedWordId = $wordId;
        $this->meaningVisible = !$this->meaningVisible;

    }
    public function mount()
    {
        $this->words = Word::take(4)->get();
    }




    public function render()
    {
        return view('livewire.words', [
            'words' => $this->words,
        ]);
    }
}
