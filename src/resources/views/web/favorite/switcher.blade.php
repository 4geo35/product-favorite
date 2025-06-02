<div>
    @php($key = "favorite-{$product->id}")
    <livewire:pf-switch-favorite :product="$product" :key="$key" lazy />
</div>
