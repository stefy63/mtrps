@props(['active'])

@php
    $classes = 'nav-link ps-0';
@endphp



<li class="nav-item" style="list-style: none; cursor: pointer">
    <a {{ $attributes->merge(['class' => $classes]) }} aria-current="page">{{ $slot }}</a>
</li>
