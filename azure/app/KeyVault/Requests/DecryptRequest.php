<?php

namespace App\KeyVault\Requests;

class DecryptRequest extends EncryptDecryptRequest
{
    public function getArray()
    {
        return [
            'alg' => $this->alg,
            'value' => $this->value,
        ];
    }
}
