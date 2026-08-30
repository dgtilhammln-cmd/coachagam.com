@props([
    'href'     => null,
    'variant'  => 'primary',   // primary | secondary | ghost | danger
    'size'     => 'md',        // xs | md | lg
    'type'     => 'button',
    'disabled' => false,
    'class'    => '',
    'id'       => null,
])

@php
    $variantClass = match($variant) {
        'secondary' => 'btn-secondary',
        'ghost'     => 'btn-ghost',
        'danger'    => 'btn-danger',
        default     => 'btn-primary',
    };

    $sizeClass = match($size) {
        'xs' => 'padding:8px 16px; font-size:12px;',
        'lg' => 'padding:16px 32px; font-size:15px;',
        default => 'padding:12px 24px; font-size:13px;',
    };

    $baseClass = "display:inline-flex; align-items:center; justify-content:center; font-weight:600; text-transform:uppercase; letter-spacing:1px; text-decoration:none; transition:all 150ms; cursor:pointer; border:none;";
    $classes = "{$class}";
@endphp

<style>
    .btn-primary { background:#1A1A1A; color:#FFFFFF; border:1px solid #1A1A1A; }
    .btn-primary:hover { background:#FFFFFF; color:#1A1A1A; }
    .btn-secondary { background:#FFFFFF; color:#1A1A1A; border:1px solid #1A1A1A; }
    .btn-secondary:hover { background:#F3F4F6; }
    .btn-ghost { background:transparent; color:#1A1A1A; }
    .btn-ghost:hover { background:#F3F4F6; }
    .btn-danger { background:#DC2626; color:#FFFFFF; }
    .btn-danger:hover { background:#B91C1C; }
</style>

@if($href)
    <a
        href="{{ $href }}"
        class="{{ $variantClass }} {{ $classes }}"
        style="{{ $baseClass }} {{ $sizeClass }}"
        @if($id) id="{{ $id }}" @endif
        @if($disabled) aria-disabled="true" tabindex="-1" @endif
    >
        {{ $slot }}
    </a>
@else
    <button
        type="{{ $type }}"
        class="{{ $variantClass }} {{ $classes }}"
        style="{{ $baseClass }} {{ $sizeClass }}"
        @if($id) id="{{ $id }}" @endif
        @if($disabled) disabled aria-disabled="true" @endif
    >
        {{ $slot }}
    </button>
@endif
