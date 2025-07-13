<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        // dd(explode(',', 'At ut, voluptas iure '));
        $courses = Course::with('sections.topics')->get();

        return view('admin.course.index', compact('courses'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required'],
            'description' => ['nullable'],
            'duration' => ['required'],
            'difficulty_level' => ['nullable'],
        ]);

        return Course::create($data);
    }

    public function create()
    {
        return view('admin.course.create');
    }

    public function show(Course $course)
    {
        $course->load('sections.topics');
        return view('courses.show', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $data = $request->validate([
            'title' => ['required'],
            'description' => ['nullable'],
            'duration' => ['required'],
            'difficulty_level' => ['nullable'],
        ]);

        $course->update($data);

        return $course;
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return response()->json();
    }
}
