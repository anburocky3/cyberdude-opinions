<?php

namespace App\Http\Controllers;

use App\Models\Suggestion;

class SiteController extends Controller
{
    public function index()
    {
        $suggestions = Suggestion::latest()->paginate(10);;

        return view('home', compact('suggestions'));
    }
}
