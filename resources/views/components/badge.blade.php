@props([
    'label'   => '',
    'variant' => 'silver',   // silver | success | warning | danger | info
])

@php
    $styles = match($variant) {
        'success' => 'background:#10B981; color:#fff;',
        'warning' => 'background:#F59E0B; color:#0F0F0F;',
        'danger'  => 'background:#EF4444; color:#fff;',
        'info'    => 'background:#3B82F6; color:#fff;',
        default   => '', // silver uses CSS class
    };
@endphp

<span
    class="badge {{ $variant === 'silver' ? 'badge-silver' : '' }}"
    style="{{ $styles }}"
>
    {{ $label ?: $slot }}
</span>
