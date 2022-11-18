<?php

namespace Botble\Signal\Repositories\Eloquent;

use Botble\Support\Repositories\Eloquent\RepositoriesAbstract;
use Botble\Signal\Repositories\Interfaces\SignalInterface;

class SignalRepository extends RepositoriesAbstract implements SignalInterface
{
    /**
    /**
     * {@inheritdoc}
     */
    public function getSignalByStatus($status = "published", $limit = 5)
    {
        $data = $this->model->leftJoin('assets', 'assets.id', '=', 'signals.asset_id')
        ->select('signals.*');
        if (!empty($status)) {
            $data = $data->where('signals.status',$status);
        }

        $data = $data->limit($limit)->orderBy('signals.created_at', 'DESC');

        return $this->applyBeforeExecuteQuery($data)->get();
    }
}
