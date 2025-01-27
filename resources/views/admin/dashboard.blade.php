@section('title')
    Admin Dashboard
@endsection

<x-app-layout>

    <div class="container mx-auto p-5 py-10">
        <div class="flex justify-between items-center mb-10"><h2 class="text-xl font-bold">All Course Syllabus</h2>
            <a href="{{route('admin.course.create')}}" wire:navigate
               class="px-4 py-2 rounded  font-medium flex items-center text-center shadow bg-gradient-to-r from-red-500 to-orange-500 text-white hover:from-red-600 hover:to-orange-600">
                Create
            </a>
        </div>
        <div class="grid grid-cols-4 gap-10 ">
            <div>
                <div class="bg-white rounded overflow-hidden shadow hover:shadow-xl cursor-pointer"
                >
                    <div class="h-32 p-5 flex justify-center items-center" style="background-color: rgb(137, 147, 190);"
                    >
                        <div class="flex justify-center items-center text-white space-x-3"><h1
                                class="text-lg font-bold text-white tracking-widest">PHP</h1><span
                                class="border border-white px-1.5 py-0.5 rounded text-sm">Tamil</span></div>
                    </div>
                    <div class="p-5"><h2 class="font-semibold text-lg">PHP Course</h2>
                        <p class="text-gray-600 py-2">Server side scripting language to build web apps in few hours.</p>
                        <div class="flex justify-between items-center text-sm pt-2"><span
                                class="ant-badge ant-badge-not-a-wrapper site-badge-count-109"><sup data-show="true"
                                                                                                    class="ant-scroll-number ant-badge-count ant-badge-multiple-words"
                                                                                                    title="#Backend"
                                                                                                    style="background-color: rgb(253, 76, 0);">#Backend</sup></span><span>09 Sept 2022</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
