<?php

namespace App\Livewire\Telnet;

use App\Models\TelnetCategory;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class Category extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    #[Rule('required|min:3')]
    public $title;
    public $selected_id;

    public $editMode=false;

    public function render()
    {
        $data=TelnetCategory::orderBy('id','ASC')->paginate(5);
        return view('livewire.telnet.category',compact('data'));
    }

    public function SaveCategory()
    {
        $this->validate();
        $create=TelnetCategory::create([
            'title'  =>     $this->title,
            'slug'   =>     Str::slug($this->title),
        ]);

        $this->dispatch('close-category');

        if ($create)
        {
            toastr()->closeButton(true)->title($create->title)->success('Category Added Successfully.');
        }else{

            toastr()->closeButton(true)->error('Category Failed to Add.');
        }
        $this->reset('title');
    }

    public function EditCategory($id)
    {
        if ($id) {
            $this->editMode = true;
            $edit = TelnetCategory::find($id);

            if ($edit) {
                // Obyekt tapıldısa, məlumatları təyin edin
                $this->title = $edit->title;
                $this->selected_id = $edit->id;
            } else {
                // Obyekt tapılmadısa, editMode-u söndürün və xəbərdarlıq göstərin
                $this->editMode = false;
                toastr()->closeButton(true)->error('Category not found.');
            }
        }

    }
    public function UpdateCategory()
    {
        $this->validate();
        try {
            $category = TelnetCategory::findOrFail($this->selected_id);
            $update = $category->update([
                'title' => $this->title,
                'slug' => Str::slug($this->title)
            ]);
            $this->dispatch('close-category');
            if ($update) {

                toastr()->closeButton(true)->title($category->title)->success('Category Update Successfully.');
            } else {
                toastr()->closeButton(true)->error('Category Failed to Update.');
            }
            // 'title' sahəsini sıfırlayır
            $this->reset('title');
        } catch (\Exception $e) {
            // İstisna halında, məsələn obyekt tapılmadıqda
            toastr()->closeButton(true)->error('Category not found.');
        }

    }

    public function DeleteCategory($id)
    {

        try {
            // $category obyektini tapır
            $category = TelnetCategory::findOrFail($id);

            // Obyekti silir
            $delete = $category->delete();

            // Kategorini bağlayır
            $this->dispatch('close-category');

            if ($delete) {
                // Uğurlu silmə
                toastr()->closeButton(true)->title($category->title)->success('Category Delete Successfully.');
            } else {
                // Uğursuz silmə
                toastr()->closeButton(true)->error('Category Failed to Delete.');
            }
        } catch (\Exception $e) {
            // İstisna halında, məsələn obyekt tapılmadıqda
            toastr()->closeButton(true)->error('Category not found.');
        }
    }


    public function new()
    {
        $this->reset('title');
        $this->editMode=false;
    }
}
