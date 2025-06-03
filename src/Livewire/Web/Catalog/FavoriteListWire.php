<?php

namespace GIS\ProductFavorite\Livewire\Web\Catalog;

use GIS\ProductFavorite\Facades\FavoriteActions;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class FavoriteListWire extends Component
{
    use WithPagination;

    public function render(): View
    {
        $list = FavoriteActions::getList();
        $products = $list->products()->orderBy("title")->paginate();
        return view("pf::livewire.web.catalog.favorite-list-wire", compact("products"));
    }
}
