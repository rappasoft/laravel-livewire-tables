<div
    x-data="{{ $alpineDefaultScope }}">
    @if($lazyPlaceholderContent ?? null)
        @include($lazyPlaceholderContent, ['isTailwind' => $isTailwind, 'isBootstrap' => $isBootstrap, 'isBootstrap4' => $isBootstrap4 ?? false, 'isBootstrap5' => $isBootstrap5 ?? false])
    @endif
</div>
