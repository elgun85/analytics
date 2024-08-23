<?php

namespace App\Livewire\Tarif;

use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class Tarif extends Component
{
    use WithPagination;

    public $editMode = false;
    public $selected_id;
    #[Rule('required')]
    public $kod;
    #[Rule('required|string')]
    public $name;
    public $mebleg, $mebleg_q, $category, $novu, $status = 0;
    protected $paginationTheme = 'bootstrap';


    public function render()
    {
        $data = \App\Models\tarif::orderBy('id', 'DESC')->get();
        return view('livewire.tarif.tarif', compact('data'));
    }

    public function SaveData()
    {
        $this->validate();
        $create = \App\Models\tarif::create(
            [
                'kod' => $this->kod,
                'name' => $this->name,
                'mebleg' => $this->mebleg,
                'mebleg_q' => $this->mebleg_q,
                'category' => $this->category,
                'novu' => $this->novu
            ]
        );
        $this->dispatch('close-modal');
        if ($create) {
            toastr()->closeButton(true)->title($create->name)->success('Data  Added Successfully.');
        } else {

            toastr()->closeButton(true)->error('Data  Failed to Add.');
        }
        $this->reset(['kod', 'name', 'mebleg', 'mebleg_q', 'category', 'novu']);
    }

    public function EditData($id)
    {
        if ($id)
        {
            $this->editMode = true;
            $edit=\App\Models\tarif::findOrFail($id);
            if ($edit)
            {
                $this->kod       =   $edit->kod;
                $this->name       =   $edit->name;
                $this->mebleg             =   $edit->mebleg;
                $this->mebleg_q          =   $edit->mebleg_q;
                $this->category              =   $edit->category;
                $this->novu       =   $edit->novu;
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
            $data = \App\Models\tarif::findOrFail($this->selected_id);
            $update = $data->update([
                'kod' => $this->kod,
                'name' => $this->name,
                'mebleg' => $this->mebleg,
                'mebleg_q' => $this->mebleg_q,
                'category' => $this->category,
                'novu' => $this->novu
            ]);
            $this->dispatch('close-modal');
            if ($update) {
                toastr()->closeButton(true)->success('Data Update Successfully.');
            } else {
                toastr()->closeButton(true)->error('Data Failed to Update.');
            }

            $this->reset(['kod', 'name', 'mebleg', 'mebleg_q', 'category', 'novu']);
        } catch (\Exception $e) {
            toastr()->closeButton(true)->error('Data not found.');
        }
    }

    public function DeleteData($id)
    {
        try {
            $data = \App\Models\tarif::findOrFail($id);
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
        $this->editMode = false;
        $this->reset(['kod', 'name', 'mebleg', 'mebleg_q', 'category', 'novu']);

    }

    public function changeStatus($id)
    {
        $status = \App\Models\tarif::where('id', $id)->first();

        if ($status->status == 1) {
            $status->status = 0;
        } else {
            $status->status = 1;
        }
        $status->save();
    }
}
