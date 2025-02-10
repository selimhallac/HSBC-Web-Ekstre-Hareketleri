<?php

namespace Phpdev;

class HSBCService
{
    private $associationCode;
    private $username;
    private $password;
    private $serviceUrl = "https://internet.hsbc.com.tr/AccountWebservice/AccountService.asmx/AccountReport";

    public function __construct($associationCode, $username, $password)
    {
        $this->associationCode = $associationCode;
        $this->username = $username;
        $this->password = $password;
    }

    public function getAccountReport($startDate, $endDate)
    {
        try {
            $postFields = http_build_query([
                'associationCode' => $this->associationCode,
                'user' => $this->username,
                'password' => $this->password,
                'startDate' => $startDate,
                'endDate' => $endDate,
            ]);

            $headers = [
                'Content-Type: application/x-www-form-urlencoded'
            ];

            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => $this->serviceUrl,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $postFields,
                CURLOPT_HTTPHEADER => $headers,
            ]);

            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

            if ($err) {
                return ['status' => false, 'response' => 'cURL error: ' . $err];
            } else {
                return ['status' => true, 'response' => $response];
            }
        } catch (Throwable $e) {
            return ['status' => false, 'response' => 'Bağlantı problemi oluştu.'];
        }
    }
}
