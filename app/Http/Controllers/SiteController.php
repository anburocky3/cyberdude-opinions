<?php

namespace App\Http\Controllers;

class SiteController extends Controller
{
    public function index()
    {
        $users = [
            ['id' => 1, 'name' => 'Alex'],
            ['id' => 2, 'name' => 'Alan'],
            ['id' => 3, 'name' => 'Tom'],
        ];

        return view('home', compact('users'));
    }
}
