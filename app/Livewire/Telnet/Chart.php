<?php

namespace App\Livewire\Telnet;

use App\Models\TelnetPersonnel;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Chart extends Component
{
    public $data = [];

    public function mount()
    {
        // Category_id sütununu cəmləmək üçün məlumatları əldə edirik
        $categories = TelnetPersonnel::where('status',1)->selectRaw('category_id, count(login) as total')
            ->groupBy('category_id')
            ->get();

            // Chart.js formatına uyğun olaraq dataları hazırlayırıq
        foreach ($categories as $category) {
            $this->data['labels'][] = $category->category->title; // Burada istənilən category_id göstərilə bilər
            $this->data['values'][] = $category->total;
        }
    }


    public function render()
    {
           return view('livewire.telnet.chart');
    }
}
