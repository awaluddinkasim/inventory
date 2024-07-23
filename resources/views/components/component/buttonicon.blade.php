@props(['label', 'type' => 'button', 'color' => 'primary', 'icon' => 'bx-pie-chart-alt' , 'block' => false, 'href' => null])


<button type="{{ $type }}" class="btn btn-{{ $color }}" {!! $href ? 'onclick="document.location.href= \'' . $href . '\' "':'' !!}>
    <span class="tf-icons bx {{ $icon }}"></span>&nbsp; {{ $label }}
  </button>
