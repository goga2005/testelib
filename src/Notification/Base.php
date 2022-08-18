<?php

namespace Goga2005\OmsNotificationClient\Notification;

use Exception;
use GuzzleHttp\Client;

class Base
{
    /**
     * @throws Exception
     */
    protected function send($url, $token, $body): array
    {
        $clientHttp = new Client();

        $head = [
            'User-Agent' => 'oms-notification-client',
            'Accept' => 'application/json',
            'Authorization' => "Bearer $token",
        ];

        $response = $clientHttp->request(
            'POST',
            $url,
            [
                'timeout' => 20,
                'headers' => $head,
                'json' => $body,
            ]
        );

        $result = json_decode($response->getBody(), true);

        return $result;
    }
}
