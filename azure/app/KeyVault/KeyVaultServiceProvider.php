<?php

namespace App\KeyVault;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;

class KeyVaultServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register()
    {
        $this->app->bind('azure.auth', CredentialFactory::class);

        $this->app->bind('azure.keyvault', function ($app) {

            if (! $app->isProduction()) {
                return new FakeKeyVaultClient($app['log']);
            }

            $credential = $app['azure.auth']->make(
                config('keyvault.credential') + ['resource' => 'https://vault.azure.net']
            );

            return KeyVaultClient::make(
                config('keyvault.vault_url'), $credential['access_token']
            );
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['azure.auth', 'azure.keyvault'];
    }
}