<?php

namespace App\SecretService\Util;

use Illuminate\Routing\Router;

trait RouterUtils
{
    private function routesWithApi(Router $router, string $version)
    {
        $apiDomain = config('secret.api_domain');
        $middlewares = ['api'];

        return $router
            ->domain($apiDomain)
            ->prefix($version)
            ->middleware($middlewares);
    }
}
