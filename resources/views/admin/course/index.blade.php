@section('title', 'Course Syllabus')

<x-app-layout>
    <div class="container mx-auto p-5 py-10">
        <div class="flex justify-between items-center mb-5"><h2 class="text-xl font-bold">All Course Syllabus</h2>
            <a href="{{route('admin.courses.create')}}" wire:navigate
               class="px-4 py-2 rounded  font-medium flex items-center text-center shadow bg-gradient-to-r from-red-500 to-orange-500 text-white hover:from-red-600 hover:to-orange-600">
                <x-fa-s-plus class="w-3 fill-current text-white  mr-2" />
                Create
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($courses as $course)
                <a href="{{ route('admin.courses.show', $course->slug) }}"
                   class="bg-white rounded overflow-hidden shadow hover:shadow-xl cursor-pointer" wire:navigate>
                    <div class="h-32 p-5 flex justify-center items-center"
                         style="background-color:{{ $course->color }};">
                        <div class="flex flex-col justify-center items-center text-white space-x-3">
                            <h1 class="text-lg font-bold text-white tracking-widest">{{ $course->title }}</h1>
                            <span
                                class="mt-3 border border-white px-1.5 py-0.5 rounded text-sm uppercase">{{$course->language}}</span>
                        </div>
                    </div>
                    <div class="p-5">
                        <h2 class="font-semibold text-lg">{{ $course->title }}</h2>
                        <p class="text-gray-600 py-2">{{ $course->description }}</p>
                        <div class="flex justify-between items-center text-sm pt-2">
                            <div>
                                @foreach(explode(', ', $course->tags) as $tag)
                                    <span
                                        class="px-2 py-1 rounded bg-orange-500 text-white text-xs">#{{ $tag }}</span>
                                @endforeach
                            </div>
                            <time
                                datetime="{{ $course->created_at  }}">{{ $course->created_at->format('d M, Y') }}</time>
                        </div>
                    </div>
                </a>
            @empty
                <div class="text-center text-gray-500 bg-white p-5 rounded shadow">
                    <p class="text-lg">No data available</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
