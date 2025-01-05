@section('page-title')
    Courses
@endsection

<x-site-layout>
    <div class="container mx-auto p-5 py-10">
        <div class="flex justify-between items-center mb-10"><h2 class="text-xl font-bold">Create courses</h2>
            <a href="{{route('admin.course.create')}}" wire:navigate
               class="px-4 py-2 rounded  font-medium flex items-center text-center shadow bg-gradient-to-r from-blue-700 to-blue-500 text-white hover:from-blue-800 hover:to-orange-600">
                Go Back
            </a>
        </div>
        <div>
            {{--            @livewire('forms.course-form')--}}
            <livewire:forms.course-form />
        </div>
    </div>
</x-site-layout>
