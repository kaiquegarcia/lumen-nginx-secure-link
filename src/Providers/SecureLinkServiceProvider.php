<?php

namespace Nginx\SecureLink\Providers;

use Illuminate\Support\ServiceProvider;

class SecureLinkServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/secure-link.php' => config_path('secure-link.php'),
        ]);
    }
}
