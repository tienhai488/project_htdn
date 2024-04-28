@if($show)
<li class="menu @if ($active) active @endif">
    <a href="{{ $url }}" aria-expanded="false" class="dropdown-toggle">
        <div class="">
            <i data-feather="{{ $icon }}"></i>
            <span>{{ $title }}</span>
        </div>
    </a>
</li>
@endif
