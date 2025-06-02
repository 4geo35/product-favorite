<?php

namespace GIS\ProductFavorite\Interfaces;

use Illuminate\Contracts\Broadcasting\HasBroadcastChannel;
use Illuminate\Contracts\Queue\QueueableEntity;
use Illuminate\Contracts\Routing\UrlRoutable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\CanBeEscapedWhenCastToString;
use Illuminate\Contracts\Support\Jsonable;
use ArrayAccess;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use JsonSerializable;
use Stringable;

interface FavoriteListInterface extends Arrayable, ArrayAccess, CanBeEscapedWhenCastToString, HasBroadcastChannel, Jsonable, JsonSerializable, QueueableEntity, Stringable, UrlRoutable
{
    public function products(): BelongsToMany;
    public function user(): BelongsTo;
}
