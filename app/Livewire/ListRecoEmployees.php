<?php

namespace App\Livewire;

use App\Models\Employee;
use App\Models\Recommendation;
use Livewire\Component;

class ListRecoEmployees extends Component
{
    public function render()
    {

        // Fetch employees with at least one recommendation
        $employeesWithRecommendations = Employee::has('recommendations')->withCount('recommendations')->get();

        return view('livewire.list-reco-employees', compact('employeesWithRecommendations'));
    }
}
