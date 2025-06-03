<?php

namespace GIS\ProductFavorite\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use GIS\Metable\Facades\MetaActions;
use Illuminate\View\View;

class FavoriteController extends Controller
{
    public function page(): View
    {
        $metas = MetaActions::renderByPage("favorite");
        return view("pf::web.favorite.page", compact('metas'));
    }
}
