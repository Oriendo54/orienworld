<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller {
    public function index() {
        return view('index');
    }

    public function about() {
        return view('about');
    }

    public function aboutMe() {
        return view('aboutMe');
    }
}
