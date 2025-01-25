@section('page-title')
    {{ $suggestion->title }}
@endsection

<x-site-layout>
    @livewire('feedback-detail', ['suggestion' => $suggestion])
</x-site-layout>
