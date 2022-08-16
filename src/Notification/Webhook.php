<?php

namespace Linx\OmsNotificationClient\Notification;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class Webhook extends Base
{
    public const ENDPOINT_CREATE = '/api/v1/clients/{clientId}/webhook';

    private const ACCEPTED_METHODS = [
        'POST',
        'PUT',
        'DELETE',
        'PATCH',
    ];

    private const ACCEPTED_AUTH_TYPES = [
        'Bearer',
        'Basic',
        'AWS',
    ];

    private const AVALIABLE_ENV = [
        'production',
        'test',
        'homolog',
        'development',
    ];

    public function create(string $clientId, string $token, array $input, string $env)
    {
dd('sdsdsds');
        $this->validateInput($clientId, $input);

        $this->validateEnv($env);

        return $this->send($this->getUrl($env, $clientId), $token, $input);
    }

    private function validateInput(string $clientId, array $input)
    {
        /** @var ValidationValidator $validator */
        $validator = Validator::make($input, [
            'clientId' => [
                'required',
                'string',
                Rule::in([$clientId]),
            ],
            'referenceId' => [
                'required',
                'string'
            ],
            'application' => [
                'required',
                'string'
            ],
            'url' => [
                'required',
                'string',
                'url'
            ],
            'method' => [
                'required',
                Rule::in(self::ACCEPTED_METHODS),
            ],
            'headers' => [
                'array',
            ],
            'retry' => [
                'integer',
                'between:1,' . config('app.webhook.max_retry'),
            ],
            'auth.type' => [
                'string',
                Rule::in(self::ACCEPTED_AUTH_TYPES),
                Rule::requiredIf(array_key_exists('auth', $input)),
            ],
            'auth.token' => [
                'string',
                Rule::requiredIf(array_key_exists('auth', $input)),
            ],
        ], [
            'clientId.in' => 'The defined clientId must be equal to ' . self::ACCEPTED_METHODS . ', otherwise change the parameter clientId.',
            'method.in' => 'The selected method is invalid. Options: ' . implode(', ', self::ACCEPTED_METHODS) . '.',
            'auth.type.in' => 'The selected auth.type is invalid. Options: ' . implode(', ', self::ACCEPTED_AUTH_TYPES) . '.',
        ])->validate();
    }
    
    private function validateEnv($env)
    {
        /** @var ValidationValidator $validator */
        $validator = Validator::make(['env' => $env], [
            'env' => [
                'string',
                Rule::in(self::AVALIABLE_ENV),
            ],
        ], [
            'env.in' => 'The selected env is invalid. Options: ' . implode(', ', self::AVALIABLE_ENV) . '.',
        ])->validate();
    }

    private function getUrl(string $env, string $clientId)
    {
        $source = dirname(__DIR__).'/../config/oms-notification.php';

        $path = str_replace('{clientId}', $clientId, self::ENDPOINT_CREATE);

        return $source[$env]['host'].$path;
    }
}
