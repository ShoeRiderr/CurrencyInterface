<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CurrencyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string,mixed>
     */
    public function toArray($request)
    {
        return [
            'currency' => $this->currency,
            'code' => $this->code,
            'mid' => $this->mid,
            'bid' => $this->bid,
            'ask' => $this->ask,
        ];
    }
}
