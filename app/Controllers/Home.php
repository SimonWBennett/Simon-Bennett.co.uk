<?php

namespace App\Controllers;

use Config\Services;

class Home extends BaseController
{
    public function index(): string
    {
        return view('holding-page');
    }
}
