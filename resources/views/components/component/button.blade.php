@props(['label', 'type' => 'button', 'color' => 'primary', 'block' => false, 'href' => null])

          <button
          type="{{ $type }}" class="btn btn-{{ $color }}" {!! $href ? 'onclick="document.location.href= \'' . $href . '\' "':'' !!}>{{ $label }}
        </button>
