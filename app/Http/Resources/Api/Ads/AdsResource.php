<?php

namespace App\Http\Resources\Api\Ads;

use Illuminate\Http\Resources\Json\JsonResource;

class AdsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'agent' => $this->agent,
            'mobile_content' => $this->mobile_content,
            'desktop_content' => $this->desktop_content,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'url' => $this->url,
            'views' => $this->views,
            'filePath' => $this->filePath,
            'spaces' => $this->spaces,
            'detectd_device' => detectDevice()
        ];
    }
}
