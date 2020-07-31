<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TabResource extends JsonResource
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
            'tab_name' => $this->tab_name
        ];
    }
}
