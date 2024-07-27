@props([
    'label',
    'type' => 'button',
    'color' => 'primary',
    'icon' => 'bx-pie-chart-alt',
    'block' => false,
    'href' => null,
    'disabled' => false,
])

<button type="{{ $type }}" class="btn btn-{{ $color }}" {!! $href ? 'onclick="document.location.href= \'' . $href . '\' "' : '' !!}
    @if ($disabled) disabled @endif>
    <span class="tf-icons bx {{ $icon }}"></span>&nbsp; {{ $label }}
</button>
