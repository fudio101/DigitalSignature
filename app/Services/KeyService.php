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
     * @param $password string Password of this certificate
     * @param $vaultPath string Path to storage certificate
     * @param $fileNameNoExtension string Name of certificate file
     * @param $configFile string Path to openssl.cnf file
     * @return array|false Associative array with the security elements: "cer"=>self signed certificate, "pem"=>private key, "file"=>path to the files
     *
     * @see http://www.php.net/manual/en/function.openssl-csr-new.php
     * @license https://gist.github.com/jlainezs/4706024
     * @author Pep Lainez
     */
    public function createCertificate(
        array $dn,
        int $duration,
        string $password,
        string $vaultPath,
        string $fileNameNoExtension,
        string $configFile = "C:/xampp/apache/conf/openssl.cnf"
    ): string|array {
        $configParams = null;
        if ($configFile) {
            $configParams = array('config' => $configFile);
        }

        // Generate a new private (and public) key pair
        $privkey = openssl_pkey_new($configParams);
        if ($privkey === false) {
            return false;
        }
        // generates a certificate signing request
//        $csr = openssl_csr_new($dn, $privkey, $configParams);
//        if ($csr === false) {
//            return false;
//        }
        // This creates a self-signed cert that is valid for $duration days
//        $sscert = openssl_csr_sign($csr, null, $privkey, $duration, $configParams);
//        if ($sscert === false) {
//            return false;
//        }
        // export the certificate and the private key
//        openssl_x509_export($sscert, $certout);
        openssl_pkey_export($privkey, $pkout, $password, $configParams);
        $puk = openssl_pkey_get_details($privkey);
        $pukout = $puk['key'];


        $file = $vaultPath.'\\'.$fileNameNoExtension;
//        file_put_contents($file.".cer", $certout);
        file_put_contents($file.".pem", $pkout);
        file_put_contents($file.'pub'.".pem", $pukout);

//        $result = array('cer' => $certout, 'pem' => $pkout, 'file' => $file);
        $result = array('private' => $pkout, 'public' => $pukout, 'file' => $file);

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
}
