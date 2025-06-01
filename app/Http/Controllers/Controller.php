<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected $category;
    protected $job;
    protected $skill;
    protected $application;
    protected $profile;
    protected $user;
    protected $college;
    protected $corporate;
    protected $subCategory;
}
