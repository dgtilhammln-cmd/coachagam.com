@props([
    'class' => '',
    'id'    => null,
    'hover' => true,
])

<div
    class="card {{ $class }}"
    @if($id) id="{{ $id }}" @endif
    @if(!$hover) style="transition:none;" @endif
>
    {{ $slot }}
</div>
