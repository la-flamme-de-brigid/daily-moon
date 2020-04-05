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
        return $this->fetch('rs', [
            'day' => $date->day,
            'month' => $date->month,
            'year'=> $date->year,
            'where' => 'Paris'
        ]);
    }

    public function getImage(Carbon $date): string
    {
        return $this->makeApiUrl('img', [
            'minute'=> $date->minute,
            'hour'=> $date->hour,
            'day' => $date->day,
            'month' => $date->month,
            'year'=> $date->year,
            'timeZone' => 'Europe/Paris',
            'hemisphere' => 'n',
            'model' => 5,
            'size' => 136,
            'bg' => 'efefef'
        ]);
    }

    public function getEphemeris(Carbon $date): array
    {
        return $this->fetch('ephem', [
            'day' => $date->day,
            'month' => $date->month,
            'year'=> $date->year,
            'timeZone' => 'Europe/Paris'
        ]);
    }

    private function fetch(string $what, array $params)
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
