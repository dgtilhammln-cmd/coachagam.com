@props([
    'label'    => '',
    'title'    => '',
    'subtitle' => '',
    'centered' => false,
])

<div style="margin-bottom: 48px; {{ $centered ? 'text-align:center;' : '' }}">
    @if($label)
        <span class="section-label">{{ $label }}</span>
    @endif

    @if($title)
        <h2 style="
            font-size: clamp(28px, 4vw, 40px);
            font-weight: 700;
            color: #FFFFFF;
            margin: 0 0 16px;
            line-height: 1.2;
            letter-spacing: -0.02em;
        ">{{ $title }}</h2>
    @endif

    @if($subtitle)
        <p style="
            font-size: 17px;
            color: #A3A3A3;
            margin: 0;
            max-width: 560px;
            line-height: 1.7;
            {{ $centered ? 'margin-left:auto; margin-right:auto;' : '' }}
        ">{{ $subtitle }}</p>
    @endif

    {{ $slot }}
</div>
