<?php

namespace GIS\ProductFavorite\Livewire\Web\Catalog;

use GIS\CategoryProduct\Interfaces\ProductInterface;
use GIS\ProductFavorite\Facades\FavoriteActions;
use Illuminate\View\View;
use Livewire\Component;

class SwitchFavoriteWire extends Component
{
    public ProductInterface $product;

    public bool $inFavorite = false;

    public function mount(): void
    {
        $this->checkFavorite();
    }

    public function render(): View
    {
        return view("pf::livewire.web.catalog.switch-favorite-wire");
    }

    public function switchProduct(): void
    {
        FavoriteActions::switchProductFavorite($this->product);
        $this->checkFavorite();
        $this->dispatch("change-favorite");
    }

    protected function checkFavorite(): void
    {
        $listIds = FavoriteActions::getListIds();
        $this->inFavorite = in_array($this->product->id, $listIds);
    }
}
