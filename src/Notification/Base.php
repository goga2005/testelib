<?php

namespace Goga2005\OmsNotificationClient\Notification;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Support\Facades\Log;

class Base
{
    protected function send($url, $token, $body)
    {
        $clientHttp = new Client();

        $head = [
            'User-Agent' => 'oms-notification-client',
            'Accept' => 'application/json',
            'Authorization' => "Bearer $token",
        ];

        try {
            $response = $clientHttp->request(
                'POST',
                $url,
                [
                    'head' => $head,
                    'json' => $body,
                ]
            );

            $result = json_decode($response->getBody(), true);
        } catch (ConnectException $e) {
            Log::error("Could not post data.", [
                'error_message' => $e->getMessage(),
                'path' => $url,
            ]);

            throw $e;
        }

        return $result;
    }
}
