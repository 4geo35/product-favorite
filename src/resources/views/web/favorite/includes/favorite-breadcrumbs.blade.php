@if (config("product-favorite.useBreadcrumbs"))
    @php($homeUrl = \Illuminate\Support\Facades\Route::has("web.home") ? route("web.home") : "/")
    <x-tt::breadcrumbs>
        <x-tt::breadcrumbs.item :url="$homeUrl">Главная</x-tt::breadcrumbs.item>
        <x-tt::breadcrumbs.item>{{ config("product-favorite.favoritePageTitle") }}</x-tt::breadcrumbs.item>
    </x-tt::breadcrumbs>
@endif
