<?php

declare(strict_types = 1);

namespace App\Service\Url;

use App\Entity\Statistic;
use App\Entity\Url;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\Selectable;
use Doctrine\ORM\EntityManagerInterface;
use GeoIp2\Exception\AddressNotFoundException;
use GeoIp2\ProviderInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * The default implementation of the statistics service.
 *
 * @author Anton Pelykh <anton.pelykh.dev@gmail.com>
 */
class UrlStatisticsService implements UrlStatisticsServiceInterface, UrlStatisticsCrudServiceInterface
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

        $this->create($statistic);
    }

    /**
     * @param int $id The statistic record identifier.
     *
     * @return Statistic|null
     */
    public function get(int $id): ?Statistic
    {
        throw new \BadMethodCallException(
            \sprintf('Method "%s" not implemented.', __METHOD__)
        );
    }

    /**
     * Returns the list of the statistic records.
     *
     * @param Criteria $criteria
     *
     * @return Collection
     */
    public function getList(Criteria $criteria): Collection
    {
        $repository = $this->entityManager->getRepository(Statistic::class);

        if (!$repository instanceof Selectable) {
            throw new \LogicException(
                sprintf('Repository must implement "%s" interface.', Selectable::class)
            );
        }

        return $repository->matching($criteria);
    }

    /**
     * @param Statistic $statistic The statistic record which need to be created.
     */
    public function create(Statistic $statistic): void
    {
        $this->entityManager->persist($statistic);
        $this->entityManager->flush();
    }

    /**
     * @param Statistic $statistic The statistic record which need to be updated.
     */
    public function update(Statistic $statistic): void
    {
        throw new \BadMethodCallException(
            \sprintf('Method "%s" not implemented.', __METHOD__)
        );
    }

    /**
     * @param Statistic $statistic The statistic record which need to be deleted.
     */
    public function delete(Statistic $statistic): void
    {
        throw new \BadMethodCallException(
            \sprintf('Method "%s" not implemented.', __METHOD__)
        );
    }
}
