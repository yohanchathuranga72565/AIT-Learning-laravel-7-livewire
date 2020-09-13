@if ($paginator->hasPages())
<ul class="d-flex justify-content-between list-unstyled">
    {{-- previous --}}
    @if ($paginator->onFirstPage())
        <li><a href="#" class="btn btn btn-outline-primary btn-sm">Prev</a></li>
    @else
        <li wire:click="previousPage"><a href="#" class="btn btn-primary btn-sm" >Prev</a></li>
    @endif
    {{-- previous end --}}

    {{-- numbers --}}
        @foreach ($elements as $element)
            <div class="d-flex">
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="mx-1 btn btn-primary btn-sm" wire:click="gotoPage({{ $page }})">{{ $page }}</li>
                        @else
                            <li class="mx-1 btn btn-outline-primary btn-sm" wire:click="gotoPage({{ $page }})">{{ $page }}</li>
                        @endif
                    @endforeach
                @endif
                
                
            </div>
        @endforeach

    {{-- numbers end --}}

    {{-- next --}}
    @if ($paginator->hasMorePages())
        <li wire:click="nextPage"><a href="#" class="btn btn-primary btn-sm">Next</a></li>
    @else
        <li><a href="#" class="btn btn btn-outline-primary btn-sm">Next</a></li>
    @endif
    {{-- next end --}}
</ul>

@endif