<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function employability()
    {
        return view('training.employability');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function entrepreneurship()
    {
        return view('training.entrepreneurship');
    }

}
