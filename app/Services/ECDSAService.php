<?php

namespace App\Services;


use Elliptic\EC;

/**
 * Class ECDSAService
 * @package App\Services
 * @author Fudio101
 * Date: 18/05/2022
 * Time: 14:24
 */
class ECDSAService
{
    /**
     * @param  int  $n
     * @return array
     */
    final public function representN(int $n): array
    {
        $result = [];
        while ($n > 0) {
            $i = 0;
            while (2 ** $i < $n) {
                $i++;
            }
            if (2 ** $i === $n) {
                $result[] = $i;
                return $result;
            }

            $i = $n % 2 ** $i === 0 ? $i : $i - 1;
            $result[] = $i;
            $n -= 2 ** $i;
        }

        return $result;
    }

    /**
     * @param  string  $msg
     * @return void
     */
    final public function test(string $msg): void
    {
        /* Create and initialize EC context
         * (better do it once and reuse it)
         * secp256k1 64chars
         * p192 48chars
         * p224 56chars
         * p256 64chars
         * p384 96chars
         * p521 132chars
         * ed25519 64chars
         */
        $ec = new EC('secp256k1');

        // Generate keys
        $key = $ec->genKeyPair();
        // Get private key from hex
        //$key = $ec->keyFromPrivate('8c618c8743db4596977bf61d47334a7c1dabfd07fe274f7fc2935958483d0b88', 'hex');

        // Sign message (can be hex sequence or array)
        $signature = $key->sign(bin2hex($msg));

        // Export DER encoded signature to hex string
        $derSign = $signature->toDER('hex');

        echo 'Message: '.$msg.'<br>';
        echo 'Private key: '.$key->getPrivate('hex').'<br>';
        echo 'Public key as "04 + x + y": '.$key->getPublic('hex').'<br>';
        echo 'Signature: '.$derSign.'<br>';

        // Get public key from hex
        //$key = $ec->keyFromPublic('04e17dd7df958e1bd958a72aafc6c645881821603c30666d02303888e16ad9ba7851e616c66bf510b3a0cf0924610728be120ccba3425e98f3dc8ea0ba7b50825d','hex');
        // Verify signature
        echo 'Verified: '.(($key->verify(bin2hex($msg), $derSign) === true) ? 'true' : 'false').'<br>';

        /*
         * Message: Anh yêu em
         * Private key: 8c618c8743db4596977bf61d47334a7c1dabfd07fe274f7fc2935958483d0b88
         * Public key as '04 + x + y': 04e17dd7df958e1bd958a72aafc6c645881821603c30666d02303888e16ad9ba7851e616c66bf510b3a0cf0924610728be120ccba3425e98f3dc8ea0ba7b50825d
         * Signature: 3045022039c6127360f8710a62654c1c5d62d57cc9823694ebf63329eb608472790f8706022100f9ee506308e1620aa3b13edc5fa9cd3ddfbd56b37219a7d2a88ab6053eea2d3e
         */
    }
}
