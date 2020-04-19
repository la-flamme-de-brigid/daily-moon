<?php

namespace DailyMoon\API;

use Carbon\Carbon;

class LunopiaClient {

    /** @var string */
    private $baseUrl;

    /** @var string */
    private $apiKey;

    /** @var Cache */
    private $cache;

    /** @var string */
    private $imageColor;

    /** @var string */
    private $imageType;

    public function __construct(
        string $baseUrl,
        string $apiKey,
        Cache $cache,
        string $imageColor,
        string $imageType
    ) {
        $this->baseUrl = $baseUrl;
        $this->apiKey = $apiKey;
        $this->cache = $cache;
        $this->imageColor = $imageColor;
        $this->imageType = $imageType;
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
            'model' => $this->imageType,
            'size' => 136,
            'bg' => $this->imageColor
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
        $key = $what . base64_encode(serialize($params));

        if ($this->cache->has($key)) {
            return $this->cache->get($key);
        }

        $url = $this->makeApiUrl($what, $params);

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $datas = curl_exec($curl);
        curl_close($curl);

        $jsonData = json_decode($datas);
        $this->cache->set($key, $jsonData);

        return $jsonData;
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
