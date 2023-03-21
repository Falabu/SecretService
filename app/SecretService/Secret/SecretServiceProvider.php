<?php

namespace App\SecretService\Secret;

use App\SecretService\Secret\Event\SecretRetrieved;
use App\SecretService\Secret\Listener\DeleteSecretWhenNoViewsLeft;
use App\SecretService\Secret\Model\Secret;
use App\SecretService\SecretResponseFactory\ISecretResponseFactory;
use App\SecretService\SecretResponseFactory\SecretResponseFactory;
use App\SecretService\Util\RouterUtils;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class SecretServiceProvider extends ServiceProvider
{
    use RouterUtils;

    public function boot(): void
    {
        $router = $this->app['router'];
        $this->routesWithApi($router, 'v1')->group(function () use ($router) {
            $this->registerRoutes($router);
        });

        Event::listen(SecretRetrieved::class, DeleteSecretWhenNoViewsLeft::class);
    }

    public function register()
    {
        $this->app->bind(ISecretResponseFactory::class, SecretResponseFactory::class);
    }

    private function registerRoutes(Router $router): void
    {
        $router->bind('secret', function (string $value) {
            return Secret::query()
                ->where('hash', $value)
                ->where('expire_after', '>', 0)
                ->where('expires_at', '>=', now())
                ->firstOrFail();
        });

        $router->resource('secret', SecretController::class)->only(['store', 'show']);
    }
}
