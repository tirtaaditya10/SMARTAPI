<?php

namespace App\KeyVault\Authentication;

interface AuthenticatorInterface
{
    public function getAuthenticationPayload();
}
