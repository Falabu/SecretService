<?php

namespace App\SecretService\Secret\Service;

use App\SecretService\Secret\Model\Secret;
use Illuminate\Database\Eloquent\Model;

interface ISecretService
{
    /**
     * @param string $secret
     * @param int $expireAfterViews
     * @param int $expireAfter
     * @return Model|Secret
     */
    public function create(string $secret, int $expireAfterViews, int $expireAfter): Model|Secret;

    /**
     * @param Secret $secret
     * @return Model|Secret
     */
    public function retrieve(Secret $secret): Model|Secret;
}
