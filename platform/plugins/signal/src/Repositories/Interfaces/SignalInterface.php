<?php

namespace Botble\Signal\Repositories\Interfaces;

use Botble\Support\Repositories\Interfaces\RepositoryInterface;

interface SignalInterface extends RepositoryInterface
{

    /**
     * @param array $condition
     * @return mixed
     */
    public function getSignalByStatus($status, $limit = 5);

    /**
     * @param array $condition
     * @return mixed
     */
    public function getSignal($limit = 5);
}
