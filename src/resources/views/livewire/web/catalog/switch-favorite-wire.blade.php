<div class="{{ $btnView ? 'mt-indent-half' : 'absolute z-10 top-0 right-0' }}">
    @if ($btnView)
        <button type="button" class="btn btn-outline-primary px-btn-x-ico"
                wire:loading.attr="disabled"
                wire:click="switchProduct">
            @if ($inFavorite) <x-pf::ico.heart width="24" height="21.6" />
            @else <x-pf::ico.heart-border width="24" height="21.6" />
            @endif
        </button>
    @else
        <button type="button" class="text-primary hover:text-primary-hover cursor-pointer p-indent-half disabled:text-primary/60"
                wire:loading.attr="disabled"
                wire:click="switchProduct">
            @if ($inFavorite) <x-pf::ico.heart width="24" height="21.6" />
            @else <x-pf::ico.heart-border width="24" height="21.6" />
            @endif
        </button>
    @endif
</div>
