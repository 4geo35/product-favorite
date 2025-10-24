<div class="{{ $btnView || $textView ? 'mt-indent-half' : 'absolute z-10 top-0 right-0' }}">
    @if ($btnView)
        <button type="button" class="btn btn-outline-primary px-btn-x-ico"
                wire:loading.attr="disabled"
                wire:click="switchProduct">
            @if ($inFavorite) <x-pf::ico.heart width="24" height="21.6" />
            @else <x-pf::ico.heart-border width="24" height="21.6" />
            @endif
        </button>
    @elseif($textView)
        <button type="button" class="inline-flex items-center cursor-pointer text-lg hover:text-primary-hover space-x-2 disabled:text-primary/60 disabled:cursor-default"
                wire:loading.attr="disabled"
                wire:click="switchProduct">
            @if ($inFavorite) <span class="text-primary"><x-pf::ico.heart width="18" height="14.5" /></span> <span>В избранном</span>
            @else <span class="text-primary"><x-pf::ico.heart-border width="18" height="14.5" /></span> <span>В избранное</span>
            @endif
        </button>
    @else
        <button type="button" class="text-primary hover:text-primary-hover cursor-pointer p-indent-half disabled:text-primary/60 disabled:cursor-default"
                wire:loading.attr="disabled"
                wire:click="switchProduct">
            @if ($inFavorite) <x-pf::ico.heart width="24" height="21.6" />
            @else <x-pf::ico.heart-border width="24" height="21.6" />
            @endif
        </button>
    @endif
</div>
