<div class="absolute z-10 top-0 right-0">
    <button type="button" class="text-primary hover:text-primary-hover cursor-pointer p-indent-half disabled:text-primary/60"
            wire:loading.attr="disabled"
            wire:click="switchProduct">
        @if ($inFavorite) <x-pf::ico.favorite />
        @else <x-pf::ico.favorite-border />
        @endif
    </button>
</div>
