<?php

namespace App\Http\Requests\Api\Ads;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SearchAdRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'agent'           => ['required', Rule::in(['mobile', 'desktop', 'both'])],
            'space_id'            => 'required|exists:spaces,id',
            'start_date'      => 'required|date|date_format:"Y-m-d"|before_or_equal:end_date',
            'end_date'      => 'required|date|date_format:"Y-m-d"|after_or_equal:start_date',
        ];
    }
}
