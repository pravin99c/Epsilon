@props([
    'class' => '',
    'type' => 'button',
    'id' => '',
    'disabled'=>false
])


<button type="{{ $type }}" {{ $attributes->merge(['class' => $class ]) }} id="{{ $id }}" {{
    $disabled ?? false ? ' disabled' :'' }}>
    {{ $slot }}
</button>
