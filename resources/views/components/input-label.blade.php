@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-danger']) }}>
    {{ $value ?? $slot }}
</label>
