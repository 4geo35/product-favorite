<div class="container">
    @if (! $products->count())
        <div>Список пуст, посмотреть <a href="{{ route('web.catalog') }}" class="text-primary hover:text-primary-hover">каталог</a></div>
    @else
        <div class="row product-row card-style">
            @foreach($products as $item)
                @php($product = \GIS\CategoryProduct\Facades\ProductActions::getTeaserData($item->id))
                <div class="col w-full sm:w-1/2 md:w-1/3 xl:w-1/4 mb-indent">
                    <x-cp::product.teaser :product="$product" />
                </div>
            @endforeach
        </div>
        <div class="flex justify-between">
            <div>Всего: {{ $products->total() }}</div>
            {{ $products->links("tt::pagination.live") }}
        </div>
    @endif
</div>
