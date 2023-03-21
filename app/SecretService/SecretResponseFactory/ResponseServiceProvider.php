<?php

namespace App\SecretService\SecretResponseFactory;

use App\SecretService\Secret\Service\ISecretService;
use App\SecretService\Secret\Service\SecretService;
use Illuminate\Support\ServiceProvider;

class ResponseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ISecretService::class, SecretService::class);
    }
}
