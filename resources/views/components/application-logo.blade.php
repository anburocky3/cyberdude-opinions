@props([
    'variant' => 'light'
])

@if($variant === 'light')
    <img src="{{ asset('img/cyberdude-white-logo.svg')  }}" alt="CyberDude Logo" />
@else
    <img src="{{ asset('img/cyberdude-dark-logo.svg') }}" alt="CyberDude Logo" />
@endif
