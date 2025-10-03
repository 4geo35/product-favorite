<div class="flex items-center justify-center">
    <a href="{{ route('web.favorite') }}" class="inline-block hover:text-primary-hover relative">
        @if (count($pIds))
            <span class="inline-flex justify-center items-center bg-primary min-w-5 py-0.5 px-1.5 rounded-full text-white text-xs font-semibold absolute -top-2 -right-2 z-10">
                {{ count($pIds) }}
            </span>
        @endif
        <x-pf::ico.favorite-border />
    </a>
</div>
