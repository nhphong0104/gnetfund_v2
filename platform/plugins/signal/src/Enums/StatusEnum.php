<?php

namespace Botble\Signal\Enums;

use Botble\Base\Supports\Enum;
use Html;

/**
 * @method static StatusEnum OPEN()
 * @method static StatusEnum CLOSE()
 */
class StatusEnum extends Enum
{
    public const OPEN = 'open';
    public const CLOSE = 'close';

    /**
     * @var string
     */
    public static $langPath = 'plugins/signal::enums.status';

    /**
     * @return string
     */
    public function toHtml()
    {
        switch ($this->value) {
            case self::OPEN:
                return Html::tag('span', self::OPEN()->label(), ['class' => 'label-info status-label'])
                    ->toHtml();
            case self::CLOSE:
                return Html::tag('span', self::CLOSE()->label(), ['class' => 'label-danger status-label'])
                    ->toHtml();
            default:
                return null;
        }
    }
}