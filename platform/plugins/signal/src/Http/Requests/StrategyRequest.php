<?php

namespace Botble\Signal\Http\Requests;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class StrategyRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'asset_id'   => 'required',
            'strategy_id'   => 'required',
            'side'   => 'required',
            'price_open'   => 'required',
            'sl'   => 'required',
            'tp'   => 'required',
            'status' => Rule::in(BaseStatusEnum::values()),
        ];
    }
}
