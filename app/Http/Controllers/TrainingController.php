<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function index()
    {
        $trainings = Training::active()
            ->when(\request()->branch_id != '', function ($query) {
                $query->where('branch_id', \request()->branch_id);
            })
            ->latest()->get();
        return response($trainings, 200);
    }
}
