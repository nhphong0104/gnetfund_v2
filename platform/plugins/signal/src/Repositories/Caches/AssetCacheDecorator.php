<?php

namespace Botble\Signal\Repositories\Caches;

use Botble\Signal\Repositories\Interfaces\AssetInterface;
use Botble\Support\Repositories\Caches\CacheAbstractDecorator;
use Botble\Signal\Repositories\Interfaces\SignalInterface;

class AssetCacheDecorator extends CacheAbstractDecorator implements AssetInterface
{
    /**
     * {@inheritdoc}
     */
    public function getAllAsset(array $condition = [])
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }
}
