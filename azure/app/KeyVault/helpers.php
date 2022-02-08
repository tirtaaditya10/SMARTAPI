<?php

function keyvault($key = null)
{
    if (! $key) {
        return app('azure.keyvault');
    }

    if (is_array($key)) {
        return collect($key)->mapWithKeys(function ($body, $key) {
            if (! is_array($body)) {
                $body = ['value' => $body];
            }
            $response = app('azure.keyvault')->setSecret(
                new App\KeyVault\Requests\SetSecretRequest(
                    $body['value'], new App\KeyVault\Requests\SecretAttributes(), $body['contentType'] ?? null
                ), $key
            );
            return [
                $key => [
                    'value' => $response->getValue(),
                    'version' => $response->getVersion()
                ]
            ];
        });
    }

    if ($key === '*') {
        return collect(app('azure.keyvault')->getSecrets()->getValue())
            ->mapWithKeys(function ($item) {
                return [ $item->getName() => keyvault($item->getName())['version'] ];
            });
    }

    $bundle = app('azure.keyvault')->getSecret($key);
    return [
        'value' => $bundle->getValue(),
        'version' => $bundle->getVersion(),
    ];
}
