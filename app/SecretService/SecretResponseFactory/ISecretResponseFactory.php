<?php

namespace App\SecretService\SecretResponseFactory;

use Symfony\Component\HttpFoundation\Response;

interface ISecretResponseFactory
{
    public function make(array $data, int $status = 200, array $headers = []): Response;
}
