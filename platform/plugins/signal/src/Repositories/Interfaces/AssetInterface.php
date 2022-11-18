<?php

namespace Botble\Signal\Repositories\Interfaces;

use Botble\Support\Repositories\Interfaces\RepositoryInterface;

interface AssetInterface extends RepositoryInterface
{
       /**
     * @param array $condition
     * @return mixed
     */
    public function getAllAsset(array $condition = []);

}
