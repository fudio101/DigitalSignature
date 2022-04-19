<?php

namespace App\Services;


use Illuminate\Support\Facades\Log;

/**
 * Class KeyService
 * @package App\Services
 * @author Fudio101
 * Date: 19/04/2022
 * Time: 19:07
 */
class KeyService
{
    /**
     * Creates an OpenSSL certificate
     * @param $dn array Associative array "key"=>"value"
     * @param $duration int Number of days which the certificate is valid
     * @return array|false Associative array with the security elements: "cer"=>self signed certificate, "pem"=>private key, "file"=>path to the files
     *
     * @see http://www.php.net/manual/en/function.openssl-csr-new.php
     * @author Pep Lainez
     */
    public function createCertificate(
        array $dn,
        int $duration,
        $password,
        $vaultPath,
        $fileNameNoExtension,
        $configFile = null
    ): string|array {
        $configParams = null;
        if ($configFile) {
            $configParams = array('config' => $configFile);
        }

        // Generate a new private (and public) key pair
        $privkey = openssl_pkey_new($configParams);
        if ($privkey === false) {
            return 'false1';
        }
        // generates a certificate signing request
        $csr = openssl_csr_new($dn, $privkey, $configParams);
        if ($csr === false) {
            return 'false2';
        }
        // This creates a self-signed cert that is valid for $duration days
        $sscert = openssl_csr_sign($csr, null, $privkey, $duration, $configParams);
        if ($sscert === false) {
            return 'false3';
        }
        // export the certificate and the private key
        openssl_x509_export($sscert, $certout);
        openssl_pkey_export($privkey, $pkout, $password, $configParams);

        $file = $vaultPath.$fileNameNoExtension;

        file_put_contents($file.".cer", $certout);
        file_put_contents($file.".pem", $pkout);

        $result = array('cer' => $certout, 'pem' => $pkout, 'file' => $file);

        // Gets any errors that occurred here
        $allErrors = '';
        while (($e = openssl_error_string()) !== false) {
            $allErrors .= $e."\n";
        }
        if ($allErrors != '') {
            $aErrs = explode("\n", $allErrors);
            foreach ($aErrs as $err) {
                Log::warning($err);
            }
        }

        return $result;
    }

    public function createKey()
    {
        $config = array(
            "digest_alg" => "sha512",
            "private_key_bits" => 2048,
            "private_key_type" => OPENSSL_KEYTYPE_RSA,
        );
        // Create the keypair
        $res = openssl_pkey_new($config);
        if (!$res) {
            dd(openssl_error_string());
        }
        // Get private key
        openssl_pkey_export($res, $privkey);
        // Get public key
        $pubkey = openssl_pkey_get_details($res);
        $pubkey = $pubkey["key"];

        echo "====PKCS1 RSA Key in Non Encrypted Format ====\n";
        var_dump($privkey);
        echo "====PKCS1 RSA Key in Encrypted Format====\n ";

        // Get private key in Encrypted Format
        openssl_pkey_export($res, $privkey, "myverystrongpassword");
        var_dump($privkey);
        echo "RSA Public Key \n ";
        // Get public key
        $pubkey = openssl_pkey_get_details($res);
        $pubkey = $pubkey["key"];
        var_dump($pubkey);
    }
}
