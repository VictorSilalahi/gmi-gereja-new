<?php

namespace App\Controllers;

class Administrasi extends BaseController
{
    public function index(): string
    {
        return view('administrasi/login');
    }
}
