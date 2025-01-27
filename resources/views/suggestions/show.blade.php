@section('page-title', $suggestion->title)
@section('meta-title', $suggestion->title)
@section('meta-description', $suggestion->description)

<x-app-layout>
    @livewire('feedback-detail', ['suggestion' => $suggestion])
</x-app-layout>
