@section('page-title', $suggestion->title)
@php
    $metaTitle = $suggestion->title;
    $metaDescription = $suggestion->desc;
@endphp

<x-app-layout>
    @livewire('feedback-detail', ['suggestion' => $suggestion])
</x-app-layout>
