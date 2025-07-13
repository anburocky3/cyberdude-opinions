<?php

namespace App\Http\Controllers;

use App\Models\Suggestion;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $suggestionsCount = Suggestion::count();
        $usersCount = User::count();
        $suggestionsByStatus = Suggestion::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        $usersByRole = User::selectRaw('role, COUNT(*) as count')
            ->groupBy('role')
            ->pluck('count', 'role');

        return view('admin.dashboard', compact('suggestionsCount', 'usersCount', 'suggestionsByStatus', 'usersByRole'));

    }
}
