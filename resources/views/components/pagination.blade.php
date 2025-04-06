@props([
    'links' => [],
    'currentPage' => 1,
    'lastPage' => 1,
    'baseUrl' => ''
])

<div class="pagination">
    @if ($currentPage > 1)
        <a href="{{ $baseUrl }}?page=1">Inicio</a>
    @endif

    @foreach ($links as $link)
        @if ($link['label'] === '&laquo; Previous' && $link['url'])
            <a href="{{ $baseUrl }}?page={{ \Illuminate\Support\Str::after($link['url'], 'page=') }}">&laquo;</a>
        @endif
    @endforeach

    {{-- Números de página --}}
    @foreach ($links as $link)
        @if (is_numeric($link['label']))
            <a href="{{ $baseUrl }}?page={{ $link['label'] }}"
               @if($link['active']) style="font-weight: bold; text-decoration: underline;" @endif>
                {{ $link['label'] }}
            </a>
        @endif
    @endforeach

    @foreach ($links as $link)
        @if ($link['label'] === 'Next &raquo;' && $link['url'])
            <a href="{{ $baseUrl }}?page={{ \Illuminate\Support\Str::after($link['url'], 'page=') }}">&raquo;</a>
        @endif
    @endforeach

    @if ($currentPage < $lastPage)
        <a href="{{ $baseUrl }}?page={{ $lastPage }}">Fim</a>
    @endif
</div>
