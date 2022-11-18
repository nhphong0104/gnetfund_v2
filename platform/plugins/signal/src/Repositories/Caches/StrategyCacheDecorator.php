<?php

namespace Botble\Signal\Repositories\Caches;

use Botble\Signal\Repositories\Interfaces\StrategyInterface;
use Botble\Support\Repositories\Caches\CacheAbstractDecorator;

class StrategyCacheDecorator extends CacheAbstractDecorator implements StrategyInterface
{
    /**
     * {@inheritdoc}
     */
    public function getAllStrategies(array $condition = [])
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }
}
