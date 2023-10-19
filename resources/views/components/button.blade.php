@props([
    'class' => '',
    'type' => 'button',
    'id' => '',
])


<button type="{{ $type }}" {{ $attributes->merge(['class' => $class ]) }}>
    {{ $slot }}
</button>
