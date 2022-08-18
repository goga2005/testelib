# OMS-Notification-Client

## Installation

To install OMS-Notification-Client, run the command below and you will get the latest
version

```sh
composer require linx/oms-notification-client
```

## Documentaion

OMS Notification client is a library used to access OMS Notification, with a pre-established class of service in order to facilitate integration.

### Webhook

Webhook is a type of notification used for integration between applications.

#### With Laravel

``` php
use Goga2005\OmsNotificationClient\Facades\WebhookFacade;

$result = WebhookFacade::create(string 'clientId', string 'token', array 'inputData', string 'env');
```

#### Without Laravel

``` php
use Goga2005\OmsNotificationClient\Notification\WebhookService;

$service = new WebhookService();
$result = $service->create(string 'clientId', string 'token', array 'inputData', string 'env');
```

License
=======

This library is released under the [MIT license](LICENSE).