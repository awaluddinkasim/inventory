@props(['label', 'type' => 'button', 'color' => 'primary', 'block' => false, 'href' => null, 'disabled' => false])

<button type="{{ $type }}" class="btn btn-{{ $color }}" {!! $href ? 'onclick="document.location.href= \'' . $href . '\' "' : '' !!}
    @if ($disabled) disabled @endif>
    {{ $label }}
</button>
