@php
    $classes = 'text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100';
@endphp

{{-- la variable $attributes toma todos los atributos que se le pasen al componente --}}
<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>