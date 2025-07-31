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
        // }

        // $selectedStatus = request('status', 'all');
        $requestedStatus = request('status');

        $validStatuses = array_keys(Suggestion::STATUS);

        // Only set selectedStatus if the requested status is valid
        $selectedStatus = in_array($requestedStatus, $validStatuses) ? $requestedStatus : 'all';

        $query = Suggestion::query();

        if ($selectedStatus !== 'all') {
            $query->where('status', $selectedStatus);
        }

        $suggestions = $query->latest()->paginate(10);

        $suggestions->appends(['status' => $selectedStatus]);

        return view('home', compact('suggestions', 'selectedStatus'));
    }
}
