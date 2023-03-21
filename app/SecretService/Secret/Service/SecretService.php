<?php

namespace App\SecretService\Secret\Service;

use App\SecretService\Secret\Event\SecretRetrieved;
use App\SecretService\Secret\Model\Secret;
use Illuminate\Database\Eloquent\Model;

class SecretService implements ISecretService
{
    /**
     * @param string $secret
     * @param int $expireAfterViews
     * @param int $expireAfter
     * @return Model|Secret
     */
    public function create(string $secret, int $expireAfterViews, int $expireAfter): Model|Secret
    {
        return Secret::query()->create([
            'secret_text' => $secret,
            'expire_after' => $expireAfterViews,
            'expires_at' => $this->getExpiresAt($expireAfter),
        ]);
    }

    /**
     * @param Secret $secret
     * @return Model|Secret
     */
    public function retrieve(Secret $secret): Model|Secret
    {
        event(new SecretRetrieved($secret));

        return $secret;
    }

    /**
     * @param int $expireAfter
     * @return string|null
     */
    private function getExpiresAt(int $expireAfter): string|null
    {
        if ($expireAfter === 0) {
            return null;
        }

        $now = now();
        return $now->addMinutes($expireAfter)->toDateTimeString();
    }
}
