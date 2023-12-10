<?php

namespace App\Livewire;

use App\Models\Userword;
use App\Models\Word;
use Livewire\Component;

class Words extends Component
{
    protected $listeners = ['remove'];

    public  $words;
    public  $words_bakup;
    public  $Step=1;
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
        if($this->Step==3){
            array_splice($this->words, array_search($wordId, array_column($this->words, 'id')), 1)[0];
            $countOriginalWords = count($this->words);
            if ($countOriginalWords === 0 ) {
                $this->saveUserWords();}
        }
        else{
            shuffle($this->words);

        }
       // $this->emit('wordsUpdated', $this->words);
    }
    public function removeWord($wordId)
    {

        $removedWord = array_splice($this->words, array_search($wordId, array_column($this->words, 'id')), 1)[0];
        $this->userWords[] = $removedWord;
        $countOriginalWords = count($this->words);
        if ($countOriginalWords === 0 && $this->Step==3) {
            $this->saveUserWords();
        }elseif ($countOriginalWords === 0){
           $this->Step++;
            $this->words=$this->words_bakup;
            $this->userWords=[];
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


        $this->userWords = [];
       // $this->dispatchBrowserEvent('show-success-animation');
    }

    public function mount()
    {
      // $this->words = Word::take(4)->get()->toArray();
        $this->words = Word::whereNotIn('id', function ($query) {
            $query->select('word_id')->from('userwords')->where('user_id', auth()->id());
        })->inRandomOrder()->take(2)->get()->toArray();
        $this->words_bakup=$this->words;
    }



    public function render()
    {
        return view('livewire.words', [
            'words' => $this->words,
        ]);
    }
}
