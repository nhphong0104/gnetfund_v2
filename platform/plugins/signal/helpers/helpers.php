<?php

use Botble\Signal\Repositories\Interfaces\AssetInterface;
use Botble\Signal\Repositories\Interfaces\StrategyInterface;
use Botble\Signal\Repositories\Interfaces\SignalInterface;

if (!function_exists('get_all_asset')) {
    /**
     * @param array $condition
     * @return mixed
     *
     */
    function get_all_asset(array $condition = [])
    {
        return app(AssetInterface::class)->getAllAsset($condition);
    }
}

if (!function_exists('get_all_strategies')) {
    /**
     * @param array $condition
     * @return mixed
     *
     */
    function get_all_strategies(array $condition = [])
    {
        return app(StrategyInterface::class)->getAllStrategies($condition);
    }
}


if (!function_exists('get_signal_open')) {
    /**
     * @param array $condition
     * @return mixed
     *
     */
    function get_signal_open(array $condition = [])
    {
        return app(SignalInterface::class)->getSignalOpen($condition);
    }
}

if (!function_exists('get_signal_by_status')) {
    /**
     * @param array $status
     * @param array $limit
     * @return mixed
     *c
     */
    function get_signal_by_status($status, $limit = 5)
    {
        return app(SignalInterface::class)->getSignalByStatus($status, $limit);
    }
}
