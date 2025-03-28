<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Attributes\Rule;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Todo;

class TodoList extends Component
{
    use WithPagination;

    public $search = '';
    public $editing = null;
    #[Rule('required|min:3|max:50')]
    public $editTitle = '';
    #[Rule('nullable|string')]
    public $editDescription = '';

    // تصفير الترقيم عند البحث
    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function toggle($id)
    {
        $todo = Todo::findOrFail($id);
        $todo->completed = !$todo->completed;
        $todo->save();
    }

    #[On('deleteTodo')]
    public function deleteTodo($id)
    {
        Todo::findOrFail($id)->delete();
        $this->dispatch('deleted');
    }

    public function editTodo($id)
    {
        $todo = Todo::find($id);
        $this->editing = $id;
        $this->editTitle = $todo->title;
        $this->editDescription = $todo->description;
    }

    public function updateTodo()
    {
        $this->validate();

        $todo = Todo::find($this->editing);
        
        $todo->update([
            'title' => $this->editTitle,
            'description' => $this->editDescription
        ]);
        
        $this->cancelEdit();
    }

    public function cancelEdit()
    {
        $this->editing = null;
        $this->editTitle = '';
        $this->editDescription = '';
    }

    #[On('todo_created')]
    public function refresh(){
        $this->resetPage();
    }
    public function render()
    {
        return view('livewire.todo-list', [
            'todos' => Todo::latest()->where('title', 'like', "%{$this->search}%")->paginate(5),
        ]);
    }
}
