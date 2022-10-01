<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GiftCampaignRuleRequest extends FormRequest
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
        	'campaign' => ['required', 'numeric'],
        	'criteria' => ['required', 'string', 'in:PRICE,ITEM,CATEGORY'],
        	'item_code' => ['required_if:criteria,ITEM', 'exclude_if:criteria,PRICE,CATEGORY', 'string'],
        	'lower_limit' => ['required_if:criteria,PRICE', 'exclude_if:criteria,ITEM,CATEGORY', 'numeric'],
        	'upper_limit' => ['required_if:criteria,PRICE', 'exclude_if:criteria,ITEM,CATEGORY', 'numeric'],
        	'category' => ['required', 'string'],
        	'product' => ['nullable', 'string'],
        	'division' => ['required', 'string'],
        	'assigned_gift' => ['required', 'string'],
        	'alloted_quantity' => ['required', 'numeric']
        ];
    }
}
