<?php

namespace Botble\Emailfund\Models;

use Botble\Base\Models\BaseModel;

class EmailfundTranslation extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'emailfunds_translations';

    /**
     * @var array
     */
    protected $fillable = [
        'lang_code',
        'emailfunds_id',
        'name',
    ];

    /**
     * @var bool
     */
    public $timestamps = false;
}
