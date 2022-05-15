<?php

namespace WiGeeky\Todo\Http\Controllers;

use Illuminate\Routing\Controller;

class TaskLabelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke()
    {

    }

}