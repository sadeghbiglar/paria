<?php

namespace App\Livewire;

use App\Models\Userword;
use App\Models\Word;
use Livewire\Component;

class Words extends Component
{
    public  $words;
    public $userWords = [];

    public $meaningVisible = false;
    public $selectedWordId;

    public function showMeaning($wordId)
    {
        $this->selectedWordId = $wordId;
        $this->meaningVisible = !$this->meaningVisible;

    }
    public function replaceWord($wordId)
    {
        shuffle($this->words);
       // $this->emit('wordsUpdated', $this->words);
    }
    public function removeWord($wordId)
    {

        $removedWord = array_splice($this->words, array_search($wordId, array_column($this->words, 'id')), 1)[0];
        $this->userWords[] = $removedWord;
        $countOriginalWords = count($this->words);
        if ($countOriginalWords === 0) {
            $this->saveUserWords();
        }

    }
    public function saveUserWords()
    {

        foreach ($this->userWords as $word) {
            Userword::create([
                'user_id' => auth()->id(),
                'word_id' => $word['id'],
            ]);
        }

        // پاک کردن آرایه userWords
        $this->userWords = [];
    }
    public function mount()
    {
       $this->words = Word::take(4)->get()->toArray();

    }



    public function render()
    {
        return view('livewire.words', [
            'words' => $this->words,
        ]);
    }
}
