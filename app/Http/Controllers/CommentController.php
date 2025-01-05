<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Suggestion;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        return Comments::all();
    }


    // public function store(Request $request, Suggestion $suggestion)
    // {
    //     $request->validate([
    //         'user_id' => ['required', 'exists:users'],
    //         'content' => 'required|string|max:255',
    //     ]);
    //
    //     $suggestion->comments()->create([
    //         'user_id' => auth()->id(),
    //         'content' => $request->content,
    //     ]);
    //
    //     return back();
    // }

    public function show(Comments $comments)
    {
        return $comments;
    }

    public function update(Request $request, Comments $comments)
    {
        $data = $request->validate([
            'user_id' => ['required', 'exists:users'],
            'content' => ['required'],
        ]);

        $comments->update($data);

        return $comments;
    }

    public function destroy(Comments $comments)
    {
        $comments->delete();

        return response()->json();
    }
}
