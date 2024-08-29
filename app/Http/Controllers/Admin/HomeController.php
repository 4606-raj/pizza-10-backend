<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Order, User};

class HomeController extends Controller
{
    public function index() {
        $data['orders'] = Order::count();
        $data['users'] = User::count();

        return view('index', compact('data'));
    }
}
