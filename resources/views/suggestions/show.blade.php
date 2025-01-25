@section('page-title')
    {{ $suggestion->title }}
@endsection

<x-app-layout>
    @livewire('feedback-detail', ['suggestion' => $suggestion])
</x-app-layout>
