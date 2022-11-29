<?php

namespace Botble\Stream\Repositories\Eloquent;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Stream\Repositories\Interfaces\WallStreetInterface;
use Botble\Support\Repositories\Eloquent\RepositoriesAbstract;
use Botble\Stream\Repositories\Interfaces\StreamInterface;

class WallStreetRepository extends RepositoriesAbstract implements WallStreetInterface
{
    /**
     * {@inheritdoc}
     */
    public function getPostWall($perPage = 20, $active = true)
    {
        $data = $this->model->select('*')
            ->orderBy('id_wall', 'desc');

        return $this->applyBeforeExecuteQuery($data)->paginate($perPage);
    }
}
