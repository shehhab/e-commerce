<?php

namespace App\Http\Resources\Authentication;

use Illuminate\Http\Resources\Json\JsonResource;

class LoginResources extends JsonResource
{
    public function toArray($request): array
    {
        // Avoid deleting tokens here, as this is a resource class
        $this->tokens()->delete();


    return [
        'message' => 'success',
        'user' => [
            'id' =>$this->id ,
            'name' => $this->name,
            'email' => $this->email,
            'phone_number'=>$this->phone_number
        ],
        'token' =>$this->when($this->createToken('auth_token'), function () {
            return $this->createToken('auth_token')->plainTextToken;
        }),
    ];

    }
}