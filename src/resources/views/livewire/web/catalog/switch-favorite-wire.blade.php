<div>
    <button type="button" class="text-base hover:text-primary-hover cursor-pointer"
            wire:click="switchProduct">
        @if ($inFavorite) <x-pf::ico.favorite />
        @else <x-pf::ico.favorite-border />
        @endif
    </button>
</div>
