<?php

declare(strict_types = 1);

namespace App\Service\Url;

/**
 * Interface to implement the url service.
 *
 * @author Anton Pelykh <anton.pelykh.dev@gmail.com>
 */
interface UrlServiceInterface extends UrlCrudServiceInterface, UrlShortenerServiceInterface
{
}
