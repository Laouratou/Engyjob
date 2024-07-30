<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\FreelancerType;
use App\Models\Project;
use App\Models\ProjectDuration;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class ProjectPage extends Component
{
    use WithPagination;

    public $categories = [];
    public $categories_left = [];
    public $project_durations = [];
    public $freelancer_types = [];
    public $projects_results = [];
    public $my_category_id = null;

    public $selected_categories = [];
    // public $selected_budget_type = [];


    public $project_fixe_count = 0;
    public $project_hourly_count = 0;

    public $budget_type = [];
    public $selected_project_durations = [];
    public $selected_freelancer_types = [];

    public function mount()
    {

        $keyword = '';
        $type_search = session()->get('type_search');

        if ($type_search == 'Projets') {
            $keyword = session()->get('keywords');
        } else


            //Log::info($keyword);

            $this->categories = Category::where('is_active', 1)
                ->orderBy('created_at', 'desc')
                ->withCount('projects')
                ->limit(8)
                ->get();

        $this->categories_left = Category::where('is_active', 1)
            ->orderBy('created_at', 'asc')
            ->withCount('projects')
            ->limit(Category::count() - 8)
            ->get();

        $this->project_fixe_count = Project::where('budget_type', 'fixed')
            ->where([
                ['is_active', 1],
                ['status', 'pending'],

            ])
            ->count();

        $this->project_hourly_count = Project::where('budget_type', 'hourly')
            ->where([
                ['is_active', 1],
                ['status', 'pending'],

            ])
            ->count();

        // ProjectDuration
        $this->project_durations = ProjectDuration::where('is_active', 1)
            ->withCount('projects')
            ->get();

        // FreelancerType
        $this->freelancer_types = FreelancerType::where('is_active', 1)->withCount('projects')->get();

        $get_category_id = session()->get('category_id');
        if (isset($get_category_id)) {
            $this->my_category_id = $get_category_id;
            // remove from session
            session()->forget('category_id');
            $this->projects_results = Project::where('category_id', $this->my_category_id)
                ->where([
                    ['is_active', 1],
                    ['status', 'pending'],

                ])
                ->get();
        } else {

            // build first query to get all projects
            $this->projects_results = Project::where('is_active', 1)
                ->orderBy('created_at', 'desc')
                ->where(function ($q) use ($keyword) {
                    if (!empty($keyword)) {
                        $q->where('name', 'like', '%' . $keyword);
                    }
                })
                ->where([
                    ['is_active', 1],
                    ['status', 'pending'],
                ])
                ->get();
            session()->forget('keywords');
        }
    }


    public function addOrRemoveCategory($category_id = -1)
    {

        // Log::info($category_id);
        if ($category_id != -1) {
            if (in_array($category_id, $this->selected_categories)) {
                $key = array_search($category_id, $this->selected_categories);
                unset($this->selected_categories[$key]);
            } else {
                $this->selected_categories[] = $category_id;
            }
        }

        // Log::info($this->selected_categories);

        $query = Project::query();
        $query->where('is_active', 1);
        $query->where([
            ['is_active', 1],
            ['status', 'pending'],
        ]);


        if (!empty($this->selected_categories)) {
            $query->whereIn('category_id', $this->selected_categories);
        } else {
            // $this->selected_categories = Category::pluck('id')->toArray();
            // $query->whereIn('category_id', $this->selected_categories);
        }


        if (sizeof($this->budget_type) > 0) {
            $query->whereIn('budget_type', $this->budget_type);
        }

        if (sizeof($this->selected_project_durations) > 0) {
            $query->whereIn('project_duration_id', $this->selected_project_durations);
        }

        if (sizeof($this->selected_freelancer_types) > 0) {
            $query->whereIn('freelancer_type_id', $this->selected_freelancer_types);
        }


        $this->projects_results = $query->get();
    }

    public function changeBudgetTypeFixe()
    {
        if (in_array('fixed', $this->budget_type)) {
            unset($this->budget_type[array_search('fixed', $this->budget_type)]);
        } else {
            $this->budget_type[] = 'fixed';
        }

        $this->addOrRemoveCategory();
    }

    public function changeBudgetTypeHourly()
    {
        if (in_array('hourly', $this->budget_type)) {
            unset($this->budget_type[array_search('hourly', $this->budget_type)]);
        } else {
            $this->budget_type[] = 'hourly';
        }

        $this->addOrRemoveCategory();
    }

    public function addOrRemoveProjectDuration($project_duration_id)
    {

        if (in_array($project_duration_id, $this->selected_project_durations)) {
            $key = array_search($project_duration_id, $this->selected_project_durations);
            unset($this->selected_project_durations[$key]);
        } else {
            $this->selected_project_durations[] = $project_duration_id;
        }

        $this->addOrRemoveCategory();
    }

    public function addOrRemoveFreelancerType($freelancer_type_id)
    {
        if (in_array($freelancer_type_id, $this->selected_freelancer_types)) {
            $key = array_search($freelancer_type_id, $this->selected_freelancer_types);
            unset($this->selected_freelancer_types[$key]);
        } else {
            $this->selected_freelancer_types[] = $freelancer_type_id;
        }

        $this->addOrRemoveCategory();
    }


    public function render()
    {
        return view('livewire.project-page');
    }
}
