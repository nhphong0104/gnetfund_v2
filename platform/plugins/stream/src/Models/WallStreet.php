<?php

namespace Botble\Stream\Models;

use Botble\Base\Traits\EnumCastable;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;

class WallStreet extends BaseModel
{
    use EnumCastable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'vnwallstreet';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'country',
        'actual',
        'affect',
        'consensus',
        'previous',
        'revised',
        'vn_pub_date',
        'is_pub',
        'fast_type',
        'star',
        'tag',
        'unit',
        'importance',
        'id_wall',
        'jid',
        'type',
        'status',
        'influence'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'status' => BaseStatusEnum::class,
    ];
}
