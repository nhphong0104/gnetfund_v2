<?php

namespace Botble\Signal\Enums;

use Botble\Base\Supports\Enum;
use Html;

/**
 * @method static SideEnums BUY()
 * @method static SideEnums SELL()
 */
class SideEnums extends Enum
{
    public const BUY = 'buy';
    public const SELL = 'sell';

    /**
     * @var string
     */
    public static $langPath = 'plugins/signal::enums.side';

    /**
     * @return string
     */
    public function toHtml()
    {
        switch ($this->value) {
            case self::BUY:
                return Html::tag('span', self::BUY()->label(), ['class' => 'label-success status-label'])
                    ->toHtml();
            case self::SELL:
                return Html::tag('span', self::SELL()->label(), ['class' => 'label-danger status-label'])
                    ->toHtml();
            default:
                return null;
        }
    }

    /**
     * @return string
     */
    public function toHtmlView()
    {
        switch ($this->value) {
            case self::BUY:
                return Html::tag('span', self::BUY()->label(), ['class' => 'signal_item_type buy'])
                    ->toHtml();
            case self::SELL:
                return Html::tag('span', self::SELL()->label(), ['class' => 'signal_item_type sell'])
                    ->toHtml();
            default:
                return null;
        }
    }
}
