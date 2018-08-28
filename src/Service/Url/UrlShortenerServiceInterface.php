<?php

declare(strict_types = 1);

namespace App\Service\Url;

use App\Entity\ShortUrl;
use App\Entity\Url;
use App\Service\Url\Exception\UrlNotFoundException;

/**
 * Interface to implement the service responsible for URL shortening.
 *
 * @author Anton Pelykh <anton.pelykh.dev@gmail.com>
 */
interface UrlShortenerServiceInterface
{
    /**
     * Makes short and url-friendly identifier from provided url instance.
     *
     * @param Url $url
     *
     * @return ShortUrl
     */
    public function makeShortUrl(Url $url): ShortUrl;

    /**
     * Makes the url instance from it's short identifier.
     *
     * @param ShortUrl $shortUrl
     *
     * @return Url
     * @throws UrlNotFoundException
     */
    public function makeUrl(ShortUrl $shortUrl): Url;
}
