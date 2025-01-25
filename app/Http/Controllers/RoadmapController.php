<?php

namespace App\Http\Controllers;

use App\Models\Roadmap;
use Illuminate\Http\Request;

class RoadmapController extends Controller
{
    public function index()
    {
        $roadmaps = Roadmap::all();
        return view('roadmaps.index', compact('roadmaps'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:suggestions,planned,in_development,ready_to_watch',
        ]);

        Roadmap::create($request->all());

        return redirect()->route('roadmaps.index')->with('success', 'Roadmap item created successfully.');
    }

    public function create()
    {
        return view('roadmaps.create');
    }

    public function show(Roadmap $roadmap)
    {
        return view('roadmaps.show', compact('roadmap'));
    }

    public function edit(Roadmap $roadmap)
    {
        return view('roadmaps.edit', compact('roadmap'));
    }

    public function update(Request $request, Roadmap $roadmap)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:suggestions,planned,in_development,ready_to_watch',
        ]);

        $roadmap->update($request->all());

        return redirect()->route('roadmaps.index')->with('success', 'Roadmap item updated successfully.');
    }

    public function destroy(Roadmap $roadmap)
    {
        $roadmap->delete();

        return redirect()->route('roadmaps.index')->with('success', 'Roadmap item deleted successfully.');
    }
}
