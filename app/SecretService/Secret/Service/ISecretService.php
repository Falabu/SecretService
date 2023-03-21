<?php

namespace App\SecretService\Secret\Service;

use App\SecretService\Secret\Model\Secret;
use Illuminate\Database\Eloquent\Model;

interface ISecretService
{
    public function create(string $secret, int $expireAfterViews, int $expireAfter): Model|Secret;

    public function retrieve(Secret $secret): Model|Secret;
}
