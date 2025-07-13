@section('title', 'Admin Dashboard')

<x-app-layout>
    <div class="container mx-auto p-5 py-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <div class="bg-white p-5 rounded shadow">
                <h3 class="text-lg font-semibold">Total Suggestions</h3>
                <p class="text-2xl">{{ $suggestionsCount }}</p>
            </div>
            <div class="bg-white p-5 rounded shadow">
                <h3 class="text-lg font-semibold">Total Users</h3>
                <p class="text-2xl">{{ $usersCount }}</p>
            </div>
            <div class="bg-white p-5 rounded shadow">
                <h3 class="text-lg font-semibold">Total Courses</h3>
                <p class="text-2xl">{{ $courseCount ?? '0' }}</p>
            </div>
            <div class="bg-white p-5 rounded shadow">
                <h3 class="text-lg font-semibold">Total Roadmaps</h3>
                <p class="text-2xl">{{ $courseCount ?? '0' }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
            <div class="bg-white p-5 rounded shadow">
                <h3 class="text-lg font-semibold mb-5">Suggestions by Status</h3>
                <canvas id="suggestionsChart" data-labels="{{ json_encode($suggestionsByStatus->keys()) }}"
                        data-values="{{ json_encode($suggestionsByStatus->values()) }}"></canvas>
            </div>
            <div class="bg-white p-5 rounded shadow">
                <h3 class="text-lg font-semibold mb-5">Users by Role</h3>
                <canvas id="usersChart" data-labels="{{ json_encode($usersByRole->keys()) }}"
                        data-values="{{ json_encode($usersByRole->values()) }}"></canvas>
            </div>
        </div>
    </div>

    @vite(['resources/js/dashboard.js'])
</x-app-layout>
