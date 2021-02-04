<?php

namespace Nginx\SecureLink\Tests;

use Illuminate\Contracts\Console\Kernel;
use Laravel\Lumen\Application;

trait CreatesApplication
{
    /**
     * Creates the application.
     *
     * @return Application
     */
    public function createApplication()
    {
        $app = require_once __DIR__ . "/../bootstrap/app.php";
        $app->make(Kernel::class)->bootstrap();

        return $app;
    }
}
