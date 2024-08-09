<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand">
        <a href="/" class="app-brand-link">
            <img src="{{ asset('assets/img/logo.png') }}" alt="" class="app-brand-logo">
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1 mt-3">
        @foreach (config('menu') as $menu)
            @if ($menu['admin-only'] && auth()->user()->role != 'admin')
                @continue
            @endif

            @if (isset($menu['submenu']))
                <li class="menu-item @if ($menu['route-active'] == request()->segment(1)) active open @endif">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx {{ $menu['icon'] ?? 'bx-circle' }}"></i>
                        <div data-i18n="{{ $menu['label'] }}">{{ $menu['label'] }}</div>
                    </a>

                    <ul class="menu-sub">
                        @foreach ($menu['submenu'] as $item)
                            <li class="menu-item @if ($item['route-active'] == request()->segment(2)) active @endif">
                                <a href="{{ isset($item['route-name']) ? route($item['route-name']) : '#' }}"
                                    class="menu-link">
                                    <div data-i18n="{{ $item['label'] }}">{{ $item['label'] }}</div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @else
                <li class="menu-item @if ($menu['route-active'] == request()->segment(1)) active @endif">
                    <a href="{{ isset($menu['route-name']) ? route($menu['route-name']) : '#' }}" class="menu-link">
                        <i class="menu-icon tf-icons bx {{ $menu['icon'] ?? 'bx-circle' }}"></i>
                        <div data-i18n="{{ $menu['label'] }}">{{ $menu['label'] }}</div>
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
</aside>
