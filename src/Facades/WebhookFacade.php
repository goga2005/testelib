<?php

namespace Linx\OmsNotificationClient\Facades;

use Illuminate\Support\Facades\Facade;
use Linx\OmsNotificationClient\Notification\Webhook;

class WebhookFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Webhook::class;
    }
}
