<?php

namespace App\Http\Resources;

use App\Models\Auther;
use Illuminate\Http\Request;
use App\Http\Resources\AutherResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title'   => $this->title, 
            'city'   => $this->city, 
            'amount'   => $this->amount, 
            'available'   => $this->available, 
            'published_at'   => $this->published_at, 
            'authers' => AutherResource::collection($this->whenLoaded('authers'))
        ];
    }
}
