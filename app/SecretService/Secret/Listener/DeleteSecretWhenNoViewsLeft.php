<?php

namespace App\SecretService\Secret\Listener;

use App\SecretService\Secret\Event\HaveSecret;

class DeleteSecretWhenNoViewsLeft
{
    public function handle(HaveSecret $event): void
    {
        $secret = $event->getSecret();
        if ($secret->haveViewsLeft()) {
            return;
        }

        $secret->delete();
    }
}
