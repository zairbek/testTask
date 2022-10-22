<?php

namespace Html\Parser\Services\Http;

class Http
{
    public function __construct(
        public ?string $baseUrl = null
    )
    {
    }

    public function get(string $path, array $queryParameters = [])
    {
        return $this->make($path, $queryParameters);
    }

    private function make(string $path, array $params = [])
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->baseUrl . $path . '?' . http_build_query($params));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
}