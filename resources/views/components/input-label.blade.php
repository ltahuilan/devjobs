@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700 dark:text-gray-300 uppercase']) }}>
    {{ $value ?? $slot }}
</label>
