<?php

namespace GIS\ProductFavorite\Livewire\Web\Catalog;

use GIS\CategoryProduct\Interfaces\ProductInterface;
use Illuminate\View\View;
use Livewire\Component;

class SwitchFavoriteWire extends Component
{
    public ProductInterface $product;

    public function render(): View
    {
        return view("pf::livewire.web.catalog.switch-favorite-wire");
    }
}
