<x-app-layout>
    @include("pf::web.favorite.includes.favorite-metas")
    @include("pf::web.favorite.includes.favorite-breadcrumbs")
    @include("pf::web.favorite.includes.favorite-h1")

    @includeIf("pv::web.variations.order-single-variation-modal")
    <livewire:pf-list-favorite />
</x-app-layout>
