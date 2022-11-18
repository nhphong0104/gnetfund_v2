<?php

namespace Botble\Signal\Repositories\Eloquent;

use Botble\Signal\Repositories\Interfaces\StrategyInterface;
use Botble\Support\Repositories\Eloquent\RepositoriesAbstract;

class  StrategyRepository extends RepositoriesAbstract implements StrategyInterface
{
    /**
    /**
     * {@inheritdoc}
     */
    public function getAllStrategies(array $condition = [])
    {
        $data = $this->model->with('slugable')->select('strategies.*');
        if (!empty($condition)) {
            $data = $data->where($condition);
        }

        $data = $data->orderBy('strategies.id', 'DESC');

        return $this->applyBeforeExecuteQuery($data)->get();
    }
}
