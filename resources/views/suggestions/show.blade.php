@section('title', $suggestion->title)
@section('og:title', $suggestion->title)
@section('og:description', $suggestion->desc.'. Cast your vote now!')

{{--@php--}}
{{--    $metaTitle = $suggestion->title;--}}
{{--    $metaDescription = $suggestion->desc;--}}
{{--@endphp--}}

<x-app-layout>
    @livewire('feedback-detail', ['suggestion' => $suggestion])
</x-app-layout>
