<div>
    <a href="{{ route('web.favorite') }}" class="hover:text-primary-hover relative">
        @if (count($pIds))
            <span class="inline-block bg-primary py-0.5 px-1.5 rounded-full text-white text-xs absolute -top-2 -right-9 z-10">{{ count($pIds) }}</span>
        @endif
        <x-pf::ico.favorite-border />
    </a>
</div>
