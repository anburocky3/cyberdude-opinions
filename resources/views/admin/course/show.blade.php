@section('title', 'Course Syllabus')

<x-app-layout>
    <div class="container mx-auto p-5 py-10">
        <h1 class="text-2xl font-bold mb-5">{{ $course->title }}</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($course->sections as $section)
                <div class="bg-white p-5 rounded shadow">
                    <h2 class="text-xl font-semibold">{{ $section->title }}</h2>
                    <ul>
                        @foreach($section->topics as $topic)
                            <li>{{ $topic->title }} ({{ $topic->duration }} mins)</li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
