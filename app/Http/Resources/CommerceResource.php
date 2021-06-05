<?php

namespace App\Http\Resources;

use App\Models\Commerce;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class CommerceResource extends JsonResource
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
            'name' => $this->name,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'image' => $this->image ? url('/') . Storage::url('') . 'commerces/' . $this->image : null,
            'queue' => $this->queue,
        ];
    }
}
