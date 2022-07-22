<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{

    public function index() {
        return view('pages.index');
    }

    public function submit() {
        return view('pages.submit');
    }

    public function admin() {
        return view('pages.admin');
    }
}
