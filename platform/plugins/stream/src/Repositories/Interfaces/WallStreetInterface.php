<?php

namespace Botble\Stream\Repositories\Interfaces;

use Botble\Support\Repositories\Interfaces\RepositoryInterface;

interface WallStreetInterface extends RepositoryInterface
{
    /**
     * @param int $perPage
     * @param int $active
     * @return mixed
     */
    public function getPostWall($perPage = 20, $active = true);

}
