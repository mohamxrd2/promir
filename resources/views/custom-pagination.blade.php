
@if ($paginator->hasPages())
    <div class="grow md:mb-0">
        <p class="text-slate-500 dark:text-zink-200">
            <b>{{ $paginator->firstItem() }}</b> à <b>{{ $paginator->lastItem() }}</b> sur <b>{{ $paginator->total() }}</b> | <b>{{ $paginator->lastItem() - $paginator->firstItem() + 1}}</b> résultats</p>
    </div>
    <div class="flex flex-wrap items-center gap-2 mb-4">
        <ul class="flex flex-wrap items-center gap-2 shrink-0">
            @if ($paginator->onFirstPage())
                <li>
                    <span class="inline-flex items-center justify-center bg-white dark:bg-zink-700 h-8 px-3 transition-all duration-150 ease-linear border rounded border-slate-200 dark:border-zink-500 text-slate-500 dark:text-zink-200" style="color: #808080; opacity: 0.7; cursor: default;">&lsaquo; Pré</span>
                </li>
            @else
                <li>
                    <button class="inline-flex items-center justify-center bg-white dark:bg-zink-700 h-8 px-3 transition-all duration-150 ease-linear border rounded border-slate-200 dark:border-zink-500 text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500 hover:bg-custom-50 dark:hover:bg-custom-500/10 focus:bg-custom-50 dark:focus:bg-custom-500/10 focus:text-custom-500 dark:focus:text-custom-500"
                            wire:click="previousPage"
                            wire:loading.attr="disabled"> &lsaquo; Pré</button>
                </li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li><span class="inline-flex items-center justify-center bg-white dark:bg-zink-700 h-8 px-3 transition-all duration-150 ease-linear border rounded border-slate-200 dark:border-zink-500 text-slate-500 dark:text-zink-200 cursor-default">{{ $element }}</span></li>
                @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li><span class="inline-flex items-center justify-center bg-white dark:bg-zink-700 w-8 h-8 transition-all duration-150 ease-linear border rounded border-slate-200 dark:border-zink-500 text-slate-500 dark:text-zink-200 cursor-default active" style="color:blue;">{{ $page }}</span></li>
                        @else
                            <li>
                                <button class="inline-flex items-center justify-center bg-white dark:bg-zink-700 w-8 h-8 transition-all duration-150 ease-linear border rounded border-slate-200 dark:border-zink-500 text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500 hover:bg-custom-50 dark:hover:bg-custom-500/10 focus:bg-custom-50 dark:focus:bg-custom-500/10 focus:text-custom-500 dark:focus:text-custom-500"
                                    wire:click="gotoPage({{ $page }})"
                                    wire:loading.attr="disabled">{{ $page }}</button>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <button class="inline-flex items-center justify-center bg-white dark:bg-zink-700 h-8 px-3 transition-all duration-150 ease-linear border rounded border-slate-200 dark:border-zink-500 text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500 hover:bg-custom-50 dark:hover:bg-custom-500/10 focus:bg-custom-50 dark:focus:bg-custom-500/10 focus:text-custom-500 dark:focus:text-custom-500"
                        wire:click="nextPage"
                        wire:loading.attr="disabled">Suiv &rsaquo;</button>
                </li>
            @else
                <li>
                    <span class="inline-flex items-center justify-center bg-white dark:bg-zink-700 h-8 px-3 transition-all duration-150 ease-linear border rounded border-slate-200 dark:border-zink-500 text-slate-500 dark:text-zink-200 cursor-default" style="color: #808080; opacity: 0.7; cursor: default;">Suiv &rsaquo;</span>
                </li>
            @endif
        </ul>
    </div>
@endif
