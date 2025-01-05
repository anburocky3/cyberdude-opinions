<?php

namespace App\Http\Controllers;

use App\Models\Suggestion;

class SuggestionController extends Controller
{
    public function index()
    {

    }

    public function show(Suggestion $suggestion)
    {
        return view('suggestions.show', [
            'suggestion' => $suggestion
        ]);
    }
}
