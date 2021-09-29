<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Interview;
use App\Questions;

class QuestionsPagination extends Component
{
    public $interviews;

    use WithPagination;

    public function render()
    {
        return view('livewire.questions-pagination', [
            'questions' => Questions::where("interview_id",$this->interviews)->simplePaginate(1),
        ]);
    }
}
