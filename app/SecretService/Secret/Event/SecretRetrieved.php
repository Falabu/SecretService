<?php

namespace App\SecretService\Secret\Event;

use App\SecretService\Secret\Model\Secret;

class SecretRetrieved implements HaveSecret
{
    public function __construct(private readonly Secret $secret)
    {
    }

    public function getSecret(): Secret
    {
        return $this->secret;
    }
}
