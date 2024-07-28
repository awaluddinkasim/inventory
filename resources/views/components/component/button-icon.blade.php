@props([
    'label',
    'type' => 'button',
    'color' => 'primary',
    'icon' => 'bx-circle',
    'small' => false,
    'href' => null,
    'disabled' => false,
])

<button type="{{ $type }}" class="btn btn-{{ $color }} @if ($small) btn-sm @endif"
    @if ($href) onclick="document.location.href='{{ $href }}'" @endif
    @if ($disabled) disabled @endif {{ $attributes }}>
    <span class="tf-icons bx {{ $icon }}"></span>&nbsp;<span>{{ $label }}</span>
</button>
