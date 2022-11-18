<?php

namespace Botble\Signal\Models;

use Botble\Base\Traits\EnumCastable;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;
use Botble\Slug\Traits\SlugTrait;

class Strategy extends BaseModel
{
    use EnumCastable;
    use SlugTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'strategies';

    /**
     * @var array
     */

    protected $fillable = [
        'name',
        'description',
        'content',
        'author_id',
        'author_type',
        'is_featured',
        'status',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'status' => BaseStatusEnum::class,
    ];
}
