<?php

namespace App\Http\Requests\Api\Ads;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class UpdateAdRequest extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            'agent'                => ['nullable', Rule::in(['mobile', 'desktop', 'both'])],
            'mobile_content'       => ['nullable', Rule::requiredIf($request->agent == 'mobile'), Rule::requiredIf($request->agent == 'both')],
            'desktop_content'      => ['nullable', Rule::requiredIf($request->agent == 'desktop'), Rule::requiredIf($request->agent == 'both')],
            'file'                 => 'nullable|mimes:jpeg,png,bmp,gif,svg,mp4,qt|max:50000',
            'start_date'           => 'nullable|date|date_format:"Y-m-d"|after_or_equal:now|before_or_equal:end_date',
            'end_date'             => 'nullable|date|date_format:"Y-m-d"|after_or_equal:now|after_or_equal:start_date',
            'url'                  => 'nullable|url',
            'ad_spaces'            => 'nullable|array',
        ];
    }
}
