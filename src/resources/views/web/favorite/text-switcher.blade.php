@php($key = "favorite-{$product->id}-" . now()->timestamp)
<livewire:pf-switch-favorite :product="$product" :key="$key" :textView="true" />
