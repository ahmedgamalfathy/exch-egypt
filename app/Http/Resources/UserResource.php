<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
           //name , email , phone ,code , expired_at , photo, email_verified_at ,password
        return [
            "id"=>$this->id,
            "name"=>$this->name,
            "email"=>$this->email,
            "phone"=>$this->phone,
            "photo"=>is_null($this->photo) ? null : asset('/images/'. $this->photo),
            "created_at"=>\Carbon\Carbon::parse($this->created_at)->diffForHumans(),
            "code"=>$this->code?$this->code:"لايوجد",
        ];
    }
}
