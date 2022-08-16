<?php

namespace Goga2005\OmsNotificationClient;

use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application;
use Goga2005\OmsNotificationClient\Notification\Webhook;

class ClientServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(Webhook::class, function ($app) {
            $this->configure($app);

            $config = $app->make('config')->get('oms-notification');
            $remoteConfig = new Webhook($config);

            return $remoteConfig;
        });
    }

    private function configure($app)
    {
        $source = dirname(__DIR__).'/config/oms-notification.php';

        if ($app instanceof Application) {
            $app->configure('oms-notification');
        }

        $this->mergeConfigFrom($source, 'oms-notification');
    }
}
