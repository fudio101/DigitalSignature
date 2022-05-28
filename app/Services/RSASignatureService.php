<?php

namespace App\Services;


/**
 * Class RSASignatureService
 * @package App\Services
 * @author Fudio101
 * Date: 28/05/2022
 * Time: 12:41
 */
class RSASignatureService
{

    /**
     * @return string
     */
    final public function genKey(): string
    {
        // Config RSA
        $config = array(
            "digest_alg" => "sha512",
            "private_key_bits" => 2048,
            "private_key_type" => OPENSSL_KEYTYPE_RSA,
        );

        // Create the private and public key
        $res = openssl_pkey_new($config);

        // Extract the private key from $res to $privateKey
        openssl_pkey_export($res, $privateKey);

        return (string) $privateKey;

        // Extract the public key from $res to $publicKey
        //$publicKey = openssl_pkey_get_details($res)['key'];

    }

    /**
     * @param  string  $key
     * @return string
     */
    final public function getKey(string $key): string
    {
        // Extract the public key from $privateKey to $publicKey
        return (string) openssl_pkey_get_details(openssl_pkey_get_private($key))['key'];
    }
}
