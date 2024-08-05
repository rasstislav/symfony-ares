<?php

namespace App\Service;

use App\Logger\Message as LoggerMessage;
use Psr\Cache\InvalidArgumentException;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class CacheService implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    private const CACHE_KEY_PREFIX = 'cache_key_';

    public function __construct(private readonly CacheInterface $cache)
    {
    }

    public function get(string $key, callable $callback, ?int $ttl = 3600): ?array
    {
        try {
            $cacheKey = static::CACHE_KEY_PREFIX;
            $cacheKey .= preg_replace('/['.preg_quote(ItemInterface::RESERVED_CHARACTERS, '/').']/', '_', $key);

            return $this->cache->get(
                $cacheKey,
                function (ItemInterface $item) use ($ttl, $callback): ?array {
                    if (null !== $ttl) {
                        $item->expiresAfter($ttl);
                    }

                    return $callback();
                },
            );
        } catch (InvalidArgumentException $e) {
            $this->logger?->error(...new LoggerMessage(
                '[CacheService::'.__FUNCTION__.'] Problém s cache',
                $e,
                [
                    'key' => $cacheKey,
                    'ttl' => $ttl,
                ],
            ));

            return $callback();
        }
    }
}
