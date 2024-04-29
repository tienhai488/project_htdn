@if($show)
<li class="@if ($active) active @endif">
    <a href="{{ $url }}">
        {{ $title }}
    </a>
</li>
@endif
