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

    public function getMoonRiseAndMoonSet(Carbon $date): object
    {
        $data = $this->fetch('rs', [
            'day' => $date->day,
            'month' => $date->month,
            'year'=> $date->year,
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
