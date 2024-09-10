<?php

namespace ErayAydin\CouponFraud\Providers;

use ErayAydin\CouponFraud\Contracts\Fingerprint;
use ErayAydin\CouponFraud\Middlewares\FingerprintMiddleware;
use ErayAydin\CouponFraud\Services\FingerprintService;
use Fingerprint\ServerAPI\Configuration;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;
use Psr\Http\Client\ClientInterface;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(Fingerprint::class, function ($app) {
            $httpClient = $app->make(ClientInterface::class);
            $config = $app->make(Repository::class);
            $fpServiceConfig = $config->get('services.fingerprint');
            $fpConfig = Configuration::getDefaultConfiguration($fpServiceConfig['secret'], $fpServiceConfig['region']);

            return new FingerprintService($httpClient, $fpConfig);
        });
    }

    public function boot(): void
    {
        $this->configureMiddleware();
    }

    private function configureMiddleware(): void
    {
        /** @var Router $router */
        $router = $this->app['router'];

        $router->aliasMiddleware('fingerprint', FingerprintMiddleware::class);
    }
}