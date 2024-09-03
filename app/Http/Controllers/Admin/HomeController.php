<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Order, User, Staff};

class HomeController extends Controller
{
    public function index() {
        $data['orders'] = Order::count();
        $data['users'] = User::count();
        $data['staff'] = Staff::count();

        return view('index', compact('data'));
    }
}
