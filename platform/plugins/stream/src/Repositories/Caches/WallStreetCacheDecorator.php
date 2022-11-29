<?php

namespace Botble\Stream\Repositories\Caches;

use Botble\Stream\Repositories\Interfaces\WallStreetInterface;
use Botble\Support\Repositories\Caches\CacheAbstractDecorator;

class WallStreetCacheDecorator extends CacheAbstractDecorator implements WallStreetInterface
{
    /**
     * {@inheritdoc}
     */
    public function getPostWall($paginate = 12, $limit = 0)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }
}
