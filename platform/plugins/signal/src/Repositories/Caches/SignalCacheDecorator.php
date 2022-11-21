<?php

namespace Botble\Signal\Repositories\Caches;

use Botble\Support\Repositories\Caches\CacheAbstractDecorator;
use Botble\Signal\Repositories\Interfaces\SignalInterface;

class SignalCacheDecorator extends CacheAbstractDecorator implements SignalInterface
{
    /**
     * {@inheritdoc}
     */
    public function getSignalByStatus($status, $limit = 5)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function getSignal($limit = 5)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }
}
