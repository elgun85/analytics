<?php

namespace App\Livewire\Todo;

use Livewire\Component;
use App\Models\Todo;

class TodoIndex extends Component
{
    public $newTodo;
    public $todos;
    public $editMode= false;
    public $todoId;


    public function mount()
    {
        $this->loadTodos();
    }


    public function loadTodos()
    {
        $this->todos = Todo::oldest()->get();
    }

    public $rules =
        [
            'newTodo' => 'required|min:3|max:255',
        ];
    public function save()
    {
        try {
            $this->validate();
          $todo=Todo::create([
                'title' => $this->newTodo,
                'is_completed' => false,
            ]);

            toastr()->success($todo->title. ' uğurla əlavə edildi.');
            $this->newTodo = '';
            $this->loadTodos();
        } catch (\Exception $e) {
            toastr()->error('Uğursuz: ' . $e->getMessage());
        }

    }
    public function edit($id)
    {
        $this->todoId= $id;

        $this->editMode = true;
        $todo = Todo::findOrFail($this->todoId);
        $this->newTodo = $todo->title;
    }
    public function update($id)
    {
        try {
            $this->todoId= $id;
            $this->editMode = true;
            $this->validate();
            $todo = Todo::findOrFail($this->todoId);
            $todo->title = $this->newTodo;
            $todo->save();

            toastr()->success($todo->title. ' uğurla yeniləndi.');
            $this->newTodo = '';
            $this->editMode = false;
            $this->loadTodos();
        } catch (\Exception $e) {
            toastr()->error('Uğursuz: ' . $e->getMessage());
        }
    }

    public function toggle($id)
    {
        try {
            $todo = Todo::findOrFail($id);
            $todo->is_completed = !$todo->is_completed;
            $todo->save();

            toastr()->success($todo->title. ' statusu yeniləndi.');
            $this->loadTodos();
        } catch (\Exception $e) {
            toastr()->error('Uğursuz: ' . $e->getMessage());
        }
    }




    public function delete($id)
    {
        try {
            $todo = Todo::findOrFail($id);
            $todo->delete();
            toastr()->success($todo->title. '  silindi.');
            $this->loadTodos();
        } catch (\Exception $e) {
            toastr()->error('Uğursuz: ' . $e->getMessage());
        }
    }

    public function render()
    {

        return view('livewire.todo.todo-index');
    }
}
