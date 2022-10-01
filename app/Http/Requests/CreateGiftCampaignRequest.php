<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateGiftCampaignRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            "company_code" => ['required', 'string'],
            "branch_code" => ['nullable', 'string'],
            "campaign_id" => ['required', 'numeric'],
            "start_date" => ['required', 'date'],
            "end_date" => ['required', 'date'],
            "notes" => ['required', 'string'],
            "name" => ['required', 'string'],
            "criteria" => ['required', 'in:CATEGORY,PRICE,ITEM'],
            "short_code" => ['required', 'string', 'unique:gift_campaigns,short_code', 'regex:/^[a-zA-Z0-9]+$/']
        ];
    }
}
