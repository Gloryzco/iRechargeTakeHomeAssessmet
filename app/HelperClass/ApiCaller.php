<?php

namespace App\HelperClass;

use Exception;

trait ApiCaller
{
    private static function encryptData(array $data): array
    {
        $key = getenv('ENCRYPTION_KEY');
        $encData = openssl_encrypt(json_encode($data), 'DES-EDE3', $key, OPENSSL_RAW_DATA);
        return ["client" => base64_encode($encData)];
    }

    public static function post(string $urlAddress, array $data)
    {
        $encrytedData = self::encryptData($data);
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('BASE_URL') . $urlAddress,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($encrytedData),
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer " . env('SECRET_KEY_ID'),
                "Content-Type: application/json",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            throw new Exception("An error occured, try again");
        }
        return json_decode($response, true);
    }
}
