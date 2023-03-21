<?php

namespace App\SecretService\Secret\Resource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SecretResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'hash' => $this->hash,
            'secretText' => $this->secret_text,
            'createdAt' => $this->created_at,
            'expiresAt' => $this->expires_at,
            'remainingViews' => $this->expire_after,
        ];
    }
}
