<?php

namespace GIS\ProductFavorite\Livewire\Web\Catalog;

use GIS\ProductFavorite\Facades\FavoriteActions;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class FavoriteIcoWire extends Component
{
    public array $pIds = [];

    public function mount(): void
    {
        $this->setProductIds();
    }

    public function render(): View
    {
        return view("pf::livewire.web.catalog.favorite-ico-wire");
    }

    #[On("change-favorite")]
    public function setProductIds(): void
    {
        $this->pIds = FavoriteActions::getListIds();
    }
}
