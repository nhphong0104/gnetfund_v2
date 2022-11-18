<?php

namespace Botble\Signal\Repositories\Eloquent;

use Botble\Signal\Repositories\Interfaces\AssetInterface;
use Botble\Support\Repositories\Eloquent\RepositoriesAbstract;

class AssetRepository extends RepositoriesAbstract implements AssetInterface
{
    /**
    /**
     * {@inheritdoc}
     */
    public function getAllAsset(array $condition = [])
    {
        $data = $this->model->select('assets.*');
        if (!empty($condition)) {
            $data = $data->where($condition);
        }

        $data = $data->orderBy('assets.order', 'DESC');

        return $this->applyBeforeExecuteQuery($data)->get();
    }
}
