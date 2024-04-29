@if($show)
<li
    class="menu
    @if ($active || $dropDownActive) active @endif"
>
    <a
        href="#{{ $id }}"
        data-bs-toggle="collapse"
        aria-expanded="false"
        class="dropdown-toggle collapsed"
    >
        <div>
            <i data-feather="{{ $icon }}"></i>
            <span>{{ $title }}</span>
        </div>
        <div>
            <i data-feather="chevron-right"></i>
        </div>
    </a>
    <ul
        class="collapse submenu list-unstyled
        @if ($active) show @endif"
        id="{{ $id }}"
        data-bs-parent="#{{ $id }}"
    >
        {{ $slot }}
    </ul>
</li>
@endif
