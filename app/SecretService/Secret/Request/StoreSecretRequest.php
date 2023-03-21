<?php

namespace App\SecretService\Secret\Request;

use App\SecretService\SecretFormRequest\SecretFormRequest;

class StoreSecretRequest extends SecretFormRequest
{
    public function rules(): array
    {
        return [
            'secret' => 'required|string',
            'expireAfterViews' => 'required|numeric|min:1',
            'expireAfter' => 'required|numeric',
        ];
    }
}
