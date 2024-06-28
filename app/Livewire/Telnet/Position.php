<?php

namespace App\Livewire\Telnet;

use App\Models\TelnetCategory;
use App\Models\TelnetPersonnel;
use App\Models\TelnetPosition;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class Position extends Component
{
    use WithPagination;
    public $editMode=false;
    public $selected_id;

    protected $paginationTheme = 'bootstrap';
   // #[Rule('string')]
    public $select;
    #[Rule('required|string')]
    public $title;


    public function render()
    {
        $categories = TelnetCategory::get();

        $positions = TelnetPosition::orderBy('id','ASC')->paginate(5);
        return view('livewire.telnet.position',compact('positions', 'categories'));
    }

    public function SaveData()
    {
        $this->validate();
        $create=TelnetPosition::create([
            'category_id'       =>      $this->select,
            'title'             =>      $this->title,
            'slug'              =>      Str::slug($this->title),
        ]);

        $this->dispatch('close-mod');
        if ($create)
        {
            toastr()->closeButton(true)->title($create->title)->success('Position  Added Successfully.');
        }else{

            toastr()->closeButton(true)->error('Position  Failed to Add.');
        }
        $this->reset(['title','select']);
    }


    public function EditData($id)
    {
        if ($id)
        {
            $this->editMode = true;
            $edit=TelnetPosition::findOrFail($id);
            if ($edit)
            {
                $this->select       =   $edit->category_id;
                $this->title        =   $edit->title;
                $this->selected_id  =   $edit->id;
            }else{
                $this->editMode = false;
                toastr()->closeButton(true)->error('Position not found.');
            }

        }
    }

    public function UpdateData()
    {
        $this->validate();
        try {
            $data = TelnetPosition::findOrFail($this->selected_id);
            $update = $data->update([
                'category_id'   =>      $this->select,
                'title'         =>      $this->title,
                'slug'          =>      Str::slug($this->title),
            ]);
            $this->dispatch('close-mod');
            if ($update) {

                toastr()->closeButton(true)->title($data->title)->success('Position Update Successfully.');
            } else {
                toastr()->closeButton(true)->error('Position Failed to Update.');
            }

            $this->reset(['title','select']);
        } catch (\Exception $e) {
            // İstisna halında, məsələn obyekt tapılmadıqda
            toastr()->closeButton(true)->error('Position not found.');
        }
    }

    public function DeleteData($id)
    {
        try {
            $data = TelnetPosition::findOrFail($id);
            $delete = $data->delete();

            $this->dispatch('close-mod');

            if ($delete) {
                toastr()->closeButton(true)->title($data->title)->success('Position Delete Successfully.');
            } else {
                toastr()->closeButton(true)->error('Position Failed to Delete.');
            }
        } catch (\Exception $e) {
            toastr()->closeButton(true)->error('Position not found.');
        }
    }

    public function new()
    {
        $this->editMode=false;
        $this->reset(['title','select']);

    }
}
