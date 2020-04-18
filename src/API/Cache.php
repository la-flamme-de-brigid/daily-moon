<?php
declare(strict_types=1);

namespace DailyMoon\API;

use Carbon\Carbon;
use Phpfastcache\Core\Pool\ExtendedCacheItemPoolInterface;

class Cache
{
    /** @var ExtendedCacheItemPoolInterface */
    private $cacheManager;

    public function __construct(ExtendedCacheItemPoolInterface $cacheManager)
    {
        $this->cacheManager = $cacheManager;
    }

    public function get(string $key)
    {
        return $this->cacheManager->getItem($key)->get();
    }

    public function set(string $key, $data): void
    {
        $cacheItem = $this->cacheManager->getItem($key);
        $cacheItem->set(
            $data
        )->expiresAfter(Carbon::now()->diffInSeconds(Carbon::tomorrow()));

        $this->cacheManager->save($cacheItem);
    }

    public function has(string $key): bool
    {
        return $this->cacheManager->getItem($key)->isHit();
    }
}
