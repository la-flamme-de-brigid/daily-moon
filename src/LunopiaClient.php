<?php

namespace DailyMoon;

use Carbon\Carbon;

class LunopiaClient {

    /** @var string */
    private $baseUrl;

    /** @var string */
    private $apiKey;

    public function __construct(string $baseUrl, string $apiKey)
    {
        $this->baseUrl = $baseUrl;
        $this->apiKey = $apiKey;
    }

    public function getMoonRiseAndMoonSet(): object
    {
        $now = Carbon::now();

        $data = $this->fetch('rs', [
            'day' => $now->day,
            'month' => $now->month,
            'year'=> $now->year,
            'where' => 'Paris'
        ]);

        return $data;
    }

    private function fetch(string $what, array $params): object
    {
        $url = $this->makeApiUrl($what, $params);

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $datas = curl_exec($curl);
        curl_close($curl);
    
        return json_decode($datas);
    }

    private function makeApiUrl(string $what, array $params): string
    {
        $default_params = [
            'key' => $this->apiKey,
            'when' => 'specDate',
            'what' => $what
        ];
    
        $url = $this->baseUrl . '/call' . '?';
        $params = array_merge($default_params, $params);
    
        $url_params = http_build_query($params);
        $url .= $url_params;
    
        return $url;
    }
}
