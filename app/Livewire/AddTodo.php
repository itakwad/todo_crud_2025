<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Attributes\Rule;
use Livewire\Component;

class AddTodo extends Component
{

    #[Rule('required|min:3|max:50')]
    public $title ;
   
    #[Rule('nullable|string')]
    public $description ;


    function create() {
        $data=$this->validate();
        Todo::create($data);
        $this->reset();
        session()->flash('success' , 'تم اضاف المهمة');
        $this->dispatch('todo_created');
    }
    public function render()
    {
        return view('livewire.add-todo');
    }
}
