<?php

namespace Botble\Signal\Http\Requests;

use Botble\Signal\Enums\StatusEnum;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class SignalRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'status' => Rule::in(StatusEnum::values()),
        ];
    }
}
