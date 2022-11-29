<?php
if (!function_exists('get_all_stream')) {
    /**
     * @param boolean $active
     * @param int $perPage
     * @return mixed
     *
     */
    function get_all_stream($active = true, $perPage = 12)
    {
        return app(\Botble\Stream\Repositories\Interfaces\StreamInterface::class)->getStream($perPage, $active);
    }
}

if (!function_exists('get_all_wall_post')) {
    /**
     * @param boolean $active
     * @param int $perPage
     * @return mixed
     *
     */
    function get_all_wall_post($active = true, $perPage = 12)
    {
        return app(\Botble\Stream\Repositories\Interfaces\WallStreetInterface::class)->getPostWall($perPage, $active);
    }
}

if (!function_exists('get_calender')) {
    /**
     * @param boolean $active
     * @param int $perPage
     * @return mixed
     *
     */
    function get_calender($today, $date )
    {
        return app(\Botble\Stream\Repositories\Interfaces\CalenderEconomiInterface::class)->getCalender($today, $date);
    }
}

if (!function_exists('get_calender_day')) {
    /**
     * @param boolean $active
     * @param int $perPage
     * @return mixed
     *
     */
    function get_calender_day()
    {
        return app(\Botble\Stream\Repositories\Interfaces\CalenderEconomiInterface::class)->getCalenderDay();
    }
}

if (!function_exists('get_wallstreet_calender')) {
    /**
     * @param boolean $active
     * @param int $perPage
     * @return mixed
     *
     */
    function get_calender_wallstreet($date, $important = 0)
    {
        return app(\Botble\Stream\Repositories\Interfaces\WallStreetCalenderInterface::class)->getWallStreetCalender($date, $important);
    }
}