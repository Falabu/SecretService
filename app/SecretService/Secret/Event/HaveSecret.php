<?php

namespace App\SecretService\Secret\Event;

use App\SecretService\Secret\Model\Secret;

interface HaveSecret
{
    public function getSecret(): Secret;
}
