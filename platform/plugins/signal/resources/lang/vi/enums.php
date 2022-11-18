<?php
use Botble\Signal\Enums\StatusSignal;
use Botble\Signal\Enums\SideEnums;
use Botble\Signal\Enums\StatusEnum;

return [
    'status_signal' => [
        StatusSignal::WAITING       => 'Trạng thái chờ',
        StatusSignal::WIN           => 'Win',
        StatusSignal::LOSS          => 'LOSS',
    ],

    'side' => [
        SideEnums::BUY     => 'Buy',
        SideEnums::SELL   => 'Sell',
    ],

    'status' => [
        StatusEnum::OPEN => "Mở lệnh",
        StatusEnum::CLOSE => "Đóng lệnh"
    ]
];