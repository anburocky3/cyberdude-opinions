@section('title')
    Roadmaps
@endsection

<div class="container mx-auto py-5">

    @if (session()->has('success'))
        <livewire:components.alert type="success" message="{{ session('success') }}" />
    @endif

    <div class="flex items-center justify-between">
        <h1 class="text-xl font-bold">Roadmap</h1>
        {{--        @auth()--}}
        {{--            <x-button href="{{ route('roadmaps.create') }}">Create</x-button>--}}
        {{--        @endauth--}}
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5 mt-5"
    >
        <div class="bg-white p-5 rounded shadow max-w-sm hover:shadow-lg h-fit"
        >
            <div class="flex items-center space-x-3">
                <div class="w-2 h-2 rounded-full bg-primary"></div>
                <h4 class="font-medium">Considering</h4>
                <span class="text-gray-600 text-sm">
                    ({{$roadmaps['suggestions']->count() }})
                </span>
            </div>
            <ul class="space-y-3">
                @if($roadmaps['suggestions']->count() === 0)
                    <livewire:roadmaps.placeholder />
                @else
                    @foreach($roadmaps['suggestions'] as $roadmap)
                        <livewire:roadmaps.roadmap-list :roadmap="$roadmap" />
                    @endforeach
                @endif
            </ul>
        </div>
        <div class="bg-white p-5 rounded shadow max-w-sm hover:shadow-lg h-fit">
            <div class="flex items-center space-x-3">
                <div class="w-2 h-2 rounded-full bg-blue-600"></div>
                <h4 class="font-medium">Planned</h4>
                <span class="text-gray-600 text-sm">
                   ({{$roadmaps['planned']->count() }})
                </span>
            </div>
            <ul class="space-y-3">
                @if($roadmaps['planned']->count() === 0)
                    <livewire:roadmaps.placeholder />
                @else
                    @foreach($roadmaps['planned'] as $roadmap)
                        <livewire:roadmaps.roadmap-list :roadmap="$roadmap" />
                    @endforeach
                @endif
            </ul>
        </div>
        <div class="bg-white p-5 rounded shadow max-w-sm hover:shadow-lg h-fit">
            <div class="flex items-center space-x-3">
                <div class="w-2 h-2 rounded-full bg-indigo-600"></div>
                <h4 class="font-medium">In Progress</h4>
                <span class="text-gray-600 text-sm">
                    ({{$roadmaps['in-progress']->count() }})
                </span>
            </div>
            <div class="space-y-3">
                @if($roadmaps['in-progress']->count() === 0)
                    <livewire:roadmaps.placeholder />
                @else
                    @foreach($roadmaps['in-progress'] as $roadmap)
                        <livewire:roadmaps.roadmap-list :roadmap="$roadmap" />
                    @endforeach
                @endif
            </div>
        </div>
        <div class="bg-white p-5 rounded shadow max-w-sm hover:shadow-lg h-fit">
            <div class="flex items-center space-x-3">
                <div class="w-2 h-2 rounded-full bg-green-600"></div>
                <h4 class="font-medium">Ready to Watch</h4>
                <span class="text-gray-600 text-sm">
                    ({{$roadmaps['completed']->count() }})
                </span>
            </div>
            <div class="space-y-3">
                @if($roadmaps['completed']->count() === 0)
                    <livewire:roadmaps.placeholder />
                @else
                    @foreach($roadmaps['completed'] as $roadmap)
                        <livewire:roadmaps.roadmap-list :roadmap="$roadmap" />
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
