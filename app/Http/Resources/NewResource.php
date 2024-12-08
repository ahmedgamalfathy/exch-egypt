<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            "id"=>$this->id,
            "title"=>$this->title,
            "notes"=>$this->notes,
            "file"=>is_null($this->file) ?null :asset('images/'.$this->file),
            "created_at"=>\Carbon\Carbon::parse($this->created_at)->diffForHumans(),
            "stok_id"=>$this->stok_id
        ];
    }
}
