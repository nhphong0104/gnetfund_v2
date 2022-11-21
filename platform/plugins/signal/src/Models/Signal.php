<?php

namespace Botble\Signal\Models;

use Botble\Base\Traits\EnumCastable;
use Botble\Base\Models\BaseModel;
use Botble\Signal\Enums\SideEnums;
use Botble\Signal\Enums\StatusEnum;
use Botble\Signal\Enums\StatusSignal;

class Signal extends BaseModel
{
    use EnumCastable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'signals';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'status',
        'asset_id',
        'strategy_id',
        'side',
        'price_open',
        'price_close',
        'sl',
        'tp',
        'pip',
        'status_signal',
        'time_start',
        'time_end',
        'note',
    ];

    /**
     * @var array
     */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id','id');
    }

    protected $casts = [
        'status' => StatusEnum::class,
        'status_signal' => StatusSignal::class,
        'side' => SideEnums::class,
    ];
}
