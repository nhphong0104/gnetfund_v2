<?php

namespace Botble\Signal\Enums;

use Botble\Base\Supports\Enum;
use Html;

/**
 * @method static StatusSignal WAITING()
 * @method static StatusSignal WIN()
 * @method static StatusSignal LOSS()
 */
class StatusSignal extends Enum
{
    public const WAITING = 'waiting';
    public const WIN = 'win';
    public const LOSS = 'loss';

    /**
     * @var string
     */
    public static $langPath = 'plugins/signal::enums.status_signal';

    /**
     * @return string
     */
    public function toHtml()
    {
        switch ($this->value) {
            case self::WAITING:
                return Html::tag('span', self::WAITING()->label(), ['class' => 'label-info status-label'])
                    ->toHtml();
            case self::WIN:
                return Html::tag('span', self::WIN()->label(), ['class' => 'label-warning status-label'])
                    ->toHtml();
            case self::LOSS:
                return Html::tag('span', self::LOSS()->label(), ['class' => 'label-mute status-label'])
                    ->toHtml();
            default:
                return null;
        }
    }
}
