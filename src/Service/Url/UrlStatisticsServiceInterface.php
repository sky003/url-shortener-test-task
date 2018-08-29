<?php

declare(strict_types = 1);

namespace App\Service\Url;

use App\Entity\Url;
use Symfony\Component\HttpFoundation\Request;

/**
 * Interface to implement the statistics service.
 *
 * @author Anton Pelykh <anton.pelykh.dev@gmail.com>
 */
interface UrlStatisticsServiceInterface
{
    /**
     * @param Url $url
     * @param Request $request
     */
    public function logUrlOpen(Url $url, Request $request): void;
}
