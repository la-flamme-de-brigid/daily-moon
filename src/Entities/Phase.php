<?php

namespace DailyMoon\Entities;

class Phase
{
    use Translator;

    const TRANSLATION = [
        'NOUVELLE LUNE' => '🌑 NEW MOON',
        'PREMIER CROISSANT' => '🌒 FIRST CRESCENT',
        'PREMIER QUARTIER' => '🌓 FIRST QUARTER',
        'GIBBEUSE CROISSANTE' => '🌔 WAXING GIBBOUS',
        'PLEINE LUNE' => '🌕 FULL MOON',
        'GIBBEUSE DECROISSANTE' => '🌖 WANING GIBBOUS',
        'DERNIER QUARTIER' => '🌗 LAST QUARTER',
        'DERNIER CROISSANT' => '🌘 LAST CRESCENT'
    ];
}
