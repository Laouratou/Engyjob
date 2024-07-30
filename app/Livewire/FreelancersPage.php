<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\FreelancerType;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class FreelancersPage extends Component
{
    public $freelancers_results = [];
    public $categories = [];
    public $freelancersTypes = [];

    public $selected_categories = [];
    public $selected_freelancers_types = [];

    public $selected_verified = 0;


    public function mount()
    {

        // $type_search = session()->get('type_search');
        $keyword = "";
        $type_search = session()->get('type_search', "");

        if ($type_search == 'Freelancer') {
            $keyword = session()->get('keywords');



            $this->freelancers_results = User::where('is_active', 1)
                ->where('user_type', 'freelancer')
                ->where(function ($q) use ($keyword) {
                    if (!empty($keyword)) {
                        $q->where('name',  'like', '%' . $keyword)
                            ->orWhere('first_name', 'like', '%' . $keyword);
                    }
                })

                ->get();
        } else {
            $this->freelancers_results = User::where('is_active', 1)
                ->where('user_type', 'freelancer')
                ->get();
        }



        $this->categories = Category::where('is_active', 1)
            ->orderBy('created_at', 'desc')
            ->withCount('freelancers')
            ->get();

        $this->freelancersTypes = FreelancerType::where('is_active', 1)
            ->withCount('freelancers')
            ->get();
        // dd($keyword);

        // session()->forget('type_search');
        // session()->forget('keywords');
    }

    public function addOrRemoveCategory($category_id = -1)
    {
        if ($category_id != -1) {
            if (in_array($category_id, $this->selected_categories)) {
                $key = array_search($category_id, $this->selected_categories);
                unset($this->selected_categories[$key]);
            } else {
                $this->selected_categories[] = $category_id;
            }
        }


        $query = User::query();
        $query->where('is_active', 1)->where('user_type', 'freelancer');


        if (!empty($this->selected_categories)) {
            $query->whereHas('profil', function ($q) {
                $q->whereIn('category_id', $this->selected_categories);
            });
        }

        //selected_freelancers_types
        if (!empty($this->selected_freelancers_types)) {
            $query->whereHas('profil', function ($q) {
                $q->whereIn('freelancer_type_id', $this->selected_freelancers_types);
            });
        }

        // selected_verified
        if ($this->selected_verified == 1) {
            $query->whereHas('profil', function ($q) {
                $q->where('is_verified', 1);
            });
        }

        $this->freelancers_results = $query->get();
    }

    public function addOrRemoveFreelancerType($freelancer_type_id)
    {

        if (in_array($freelancer_type_id, $this->selected_freelancers_types)) {
            $key = array_search($freelancer_type_id, $this->selected_freelancers_types);
            unset($this->selected_freelancers_types[$key]);
        } else {
            $this->selected_freelancers_types[] = $freelancer_type_id;
        }

        $this->addOrRemoveCategory();
    }

    public function changeVerified()
    {
        $this->selected_verified = $this->selected_verified == 0 ? 1 : 0;
        $this->addOrRemoveCategory();
    }

    public function render()
    {
        return view('livewire.freelancers-page');
    }
}
