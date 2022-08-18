<?php

namespace Goga2005\OmsNotificationClient\Facades;

use Illuminate\Support\Facades\Facade;
use Goga2005\OmsNotificationClient\Notification\WebhookService;

class WebhookFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return WebhookService::class;
    }
}
