<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Project;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class LoadMoreWidget extends Component
{
    use WithPagination;

    public $amount = 6;

    public function render()
    {
        $categories = Category::where('is_active', 1)
            ->orderBy('created_at', 'desc')
            ->withCount('projects')
            ->limit(12)
            ->get();

        $freelancers = User::where('user_type', 'freelancer')
            ->where('is_active', 1)
            ->orderBy('name', 'asc')
            ->limit(12)
            ->get();

        $projects = Project::where('is_active', 1)
            ->where('en_vedette', 1)
            ->orderBy('name', 'asc')
            ->paginate($this->amount);

        return view('livewire.load-more-widget', compact('projects', 'categories', 'freelancers'));
    }

    public function loadMore()
    {
        $this->amount += 6;
    }
}
