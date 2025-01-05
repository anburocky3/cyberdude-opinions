@section('page-title')
    Suggestion Details
@endsection

<x-site-layout>
    @livewire('feedback-detail', ['suggestion' => $suggestion])
</x-site-layout>
