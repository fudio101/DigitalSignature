<?php

namespace App\Services;


use Illuminate\Support\Facades\Hash;
use OpenSSLAsymmetricKey;

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
    final public function getPublicKey(string $key): string
    {
        // Extract the public key from $privateKey to $publicKey
        return (string) openssl_pkey_get_details(openssl_pkey_get_private($key))['key'];
    }

    /**
     * @param  string  $key
     * @return OpenSSLAsymmetricKey|bool
     */
    final public function getPKey(string $key): OpenSSLAsymmetricKey|bool
    {
        return openssl_pkey_get_private($key);
    }

    /**
     * @param  string  $key
     * @return OpenSSLAsymmetricKey|bool
     */
    final public function getUKey(string $key): OpenSSLAsymmetricKey|bool
    {
        return openssl_pkey_get_public($key);
    }

    /**
     * @param  OpenSSLAsymmetricKey  $key
     * @param  string  $msg
     * @return array
     */
    final public function sign(OpenSSLAsymmetricKey $key, string $msg): array
    {
        $hashValue = Hash::make($msg);

        openssl_private_encrypt($hashValue, $encrypted, $key);

        return [$hashValue, base64_encode($encrypted)];
    }

    final public function verify(OpenSSLAsymmetricKey $key, string $msg, string $signature)
    {
        openssl_public_decrypt(base64_decode($signature), $decrypted, $key);

        return Hash::check($msg, $decrypted);
    }

    final public function verifyText(string $textKey, string $msg, string $signature)
    {
        $key = $this->getUKey($textKey);

        openssl_public_decrypt(base64_decode($signature), $decrypted, $key);

        return Hash::check($msg, $decrypted);
    }
}
