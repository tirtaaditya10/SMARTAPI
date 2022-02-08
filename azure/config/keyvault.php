<?php

return [

    'credential' => [
        'endpoint' => env('IDENTITY_ENDPOINT'),
        'identity' => env('IDENTITY_HEADER', null)
    ],

    'vault_url' => 'https://nidn-dv-loyaidb2c-02-key.vault.azure.net/',
];
