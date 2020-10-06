<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'tab_id' => $this->tab_id,
            'item_name' => $this->item_name,
            'item_amount' => $this->item_amount,
            'item_is_income' => $this->item_is_income,
        ];
    }
}
