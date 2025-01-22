<?php

namespace App\Http\Controllers;

use App\Models\Suggestion;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    public function index()
    {
        // if (config('app.env') === 'local') {
        //     $suggestions = Suggestion::on('production_mysql')->latest()->paginate(10);
        // } else {
        $suggestions = Suggestion::latest()->paginate(10);
        // }

        return view('home', compact('suggestions'));
    }
}
