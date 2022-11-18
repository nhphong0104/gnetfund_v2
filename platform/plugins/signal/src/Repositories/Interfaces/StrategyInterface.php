<?php

namespace Botble\Signal\Repositories\Interfaces;

use Botble\Support\Repositories\Interfaces\RepositoryInterface;

interface StrategyInterface extends RepositoryInterface
{
    /**
     * @param array $condition
     * @return mixed
     */
    public function getAllStrategies(array $condition = []);

}
