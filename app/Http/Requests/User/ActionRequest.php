<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use BenSampo\Enum\Rules\EnumValue;
use App\Enums\ActionType;

class ActionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string,mixed>
     */
    public function rules()
    {
        return [
            'state' => ['required', new EnumValue(ActionType::class, false)],
            'currencies' => ['required', 'array'],
            'currencies.*' => ['required', 'exists:currencies,id'],
        ];
    }
}
