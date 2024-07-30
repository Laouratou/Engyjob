<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //change model is_active function
    /**
     * Toggle the active status of the model.
     */
    public function toggleActive(Request $request)
    {
        $model = "App\Models" . "\\" . $request->model;
        $id = $request->id;

        $model = $model::find($id);
        $model->is_active = !$model->is_active;
        $model->save();

        return "success";
    }

    // blocked
    public function blocked(): \Illuminate\Contracts\View\View
    {
        return view('blocked');
    }

    public function success_payment(): \Illuminate\Contracts\View\View
{
    return view('payment.success_payment');
}

public function success_retrait(): \Illuminate\Contracts\View\View 
{
    return view('Retrait.success');
}

public function error_payment(): \Illuminate\Contracts\View\View
{
    return view('payment.error_payment');
}

public function error_retrait(): \Illuminate\Contracts\View\View
{
    return view('Retrait.echec');
}


}
