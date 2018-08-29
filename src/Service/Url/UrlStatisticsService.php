<?php

declare(strict_types = 1);

namespace App\Service\Url;

use App\Entity\Statistic;
use App\Entity\Url;
use Doctrine\ORM\EntityManagerInterface;
use GeoIp2\Exception\AddressNotFoundException;
use GeoIp2\ProviderInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * The default implementation of the statistics service.
 *
 * @author Anton Pelykh <anton.pelykh.dev@gmail.com>
 */
class UrlStatisticsService implements UrlStatisticsServiceInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var ProviderInterface
     */
    private $geoIpProvider;

    /**
     * UrlStatisticsService constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param ProviderInterface $geoIpProvider
     */
    public function __construct(EntityManagerInterface $entityManager, ProviderInterface $geoIpProvider)
    {
        $this->entityManager = $entityManager;
        $this->geoIpProvider = $geoIpProvider;
    }

    /**
     * Logs the URL opening to the database table.
     *
     * @param Url $url
     * @param Request $request
     */
    public function logUrlOpen(Url $url, Request $request): void
    {
        $statistic = new Statistic();
        $statistic
            ->setUrl($url)
            ->setUserAgent($request->headers->get('User-Agent'))
            ->setReferer($request->headers->get('Referer'));

        try {
            $statistic->setCountry(
                $this->geoIpProvider->city($request->getClientIp())->country->isoCode
            );
        } catch (AddressNotFoundException $e) {}

        $this->entityManager->persist($statistic);
        $this->entityManager->flush();
    }
}
