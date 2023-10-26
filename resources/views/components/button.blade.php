@props([
    'class' => '',
    'type' => 'button',
    'id' => '',
])


<button type="{{ $type }}" {{ $attributes->merge(['class' => $class ]) }} id="{{ $id }}">
    {{ $slot }}
</button>
