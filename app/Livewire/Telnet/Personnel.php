<?php

namespace App\Livewire\Telnet;

use App\Models\TelnetCategory;
use App\Models\TelnetPersonnel;
use App\Models\TelnetPosition;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class Personnel extends Component
{
    use WithPagination;
    public $editMode=false;
    public $selected_id;

    protected $paginationTheme = 'bootstrap';
    public $category_id,$position_id,$password,$status ='1';
    #[Rule('required|string')]
    public $login;
    #[Rule('required|string')]
    public $name;


    public function render()
    {
        $categories =TelnetCategory::get();
        $positions  =TelnetPosition::get();
        $personnels =TelnetPersonnel::orderBy('login','ASC')->get();
        return view('livewire.telnet.personnel',compact('categories','positions','personnels'));
    }

    public function SaveData()
    {
        $this->validate();
        $create=TelnetPersonnel::create(
            [
                'category_id'       =>      $this->category_id,
                'position_id'       =>      $this->position_id,
                'login'             =>      $this->login,
                'password'          =>      $this->password,
                'name'              =>      $this->name,
                'status'            =>      $this->status
                ]
        );
        $this->dispatch('close-modal');
        if ($create)
        {
            toastr()->closeButton(true)->title($create->login)->success('Personnel  Added Successfully.');
        }else{

            toastr()->closeButton(true)->error('Personnel  Failed to Add.');
        }
        $this->reset(['category_id','position_id','login','password','name']);
    }

    public function EditData($id)
    {
        if ($id)
        {
            $this->editMode = true;
            $edit=TelnetPersonnel::findOrFail($id);
            if ($edit)
            {
                $this->category_id       =   $edit->category_id;
                $this->position_id       =   $edit->position_id;
                $this->login             =   $edit->login;
                $this->password          =   $edit->password;
                $this->name              =   $edit->name;
                $this->selected_id       =   $edit->id;
            }else{
                $this->editMode = false;
                toastr()->closeButton(true)->error('Personnel not found.');
            }

        }
    }

    public function UpdateData()
    {
        $this->validate();
        try {
            $data = TelnetPersonnel::findOrFail($this->selected_id);
            $update = $data->update([
                'category_id'       =>      $this->category_id,
                'position_id'       =>      $this->position_id,
                'login'             =>      $this->login,
                'password'          =>      $this->password,
                'name'              =>      $this->name
            ]);
            $this->dispatch('close-modal');
            if ($update) {

                toastr()->closeButton(true)->success('Personnel Update Successfully.');
            } else {
                toastr()->closeButton(true)->error('Personnel Failed to Update.');
            }

            $this->reset(['category_id','position_id','login','password','name']);
        } catch (\Exception $e) {
            toastr()->closeButton(true)->error('Personnel not found.');
        }

    }

    public function DeleteData($id)
    {
        try {
            $data = TelnetPersonnel::findOrFail($id);
            $delete = $data->delete();

            $this->dispatch('close-modal');

            if ($delete) {
                toastr()->closeButton(true)->success('Personnel Delete Successfully.');
            } else {
                toastr()->closeButton(true)->error('Personnel Failed to Delete.');
            }
        } catch (\Exception $e) {
            toastr()->closeButton(true)->error('Personnel not found.');
        }

    }





    public function new()
    {
        $this->editMode=false;
        $this->reset(['category_id','position_id','login','password','name','status']);

    }

    public function changeStatus($id)
    {
        $status=TelnetPersonnel::where('id',$id)->first();

        if ($status->status == 1)
        {
            $status->status =0;
        }else{
            $status->status=1;
        }
       $status->save();
    }
}
