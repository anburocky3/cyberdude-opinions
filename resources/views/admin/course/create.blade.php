@section('title', 'Create Courses')

<x-site-layout>
    {{--     <div class="container mx-auto p-5 py-10"> --}}
    {{--         <div class="flex items-center mb-5"> --}}
    {{--             <a href="{{route('admin.courses.index')}}" wire:navigate> --}}
    {{--                 <x-fa-s-arrow-left class="w-4 fill-current text-blue-700 hover:text-blue-800 mr-3" /> --}}
    {{--             </a> --}}
    {{--             <h2 class="text-xl font-bold">Create courses</h2> --}}
    {{--         </div> --}}
    {{--         <div class="bg-white p-10 rounded"> --}}
    <livewire:forms.course-form />
    {{--         </div> --}}
    {{--     </div> --}}
</x-site-layout>
