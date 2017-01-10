<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Request;
use Validator;

class HomeController extends Controller
{
    public function __construct()
    {
//        $this->middleware('guest', ['except' => 'getLogout']);
    }

    protected function getIndex()
    {
        return view('admin.home.index');
    }
}
