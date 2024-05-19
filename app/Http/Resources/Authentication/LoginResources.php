<?php

namespace App\Http\Resources\Authentication;

use Illuminate\Http\Resources\Json\JsonResource;

class LoginResources extends JsonResource
{
    public function toArray($request): array
    {
        // Avoid deleting tokens here, as this is a resource class
        $this->tokens()->delete();

        // Set a default image URL

        // Initialize an array to hold user data
        $userData = [
            "id" => $this->whenHas('id'),
            'token' => $this->when($this->createToken('auth_token'), function () {
                return $this->createToken('auth_token')->plainTextToken;
            }),
            "email" => $this->whenHas('email'),
            "name" => $this->whenHas('name'),
            'email_verified' => (bool) $this->email_verified_at,
            "phone_number" => $this->whenHas('phone_number'),
        ];


        return $userData;
    }
}
