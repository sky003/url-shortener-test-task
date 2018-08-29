<?php

declare(strict_types = 1);

namespace App\Service\Url;

use App\Entity\Statistic;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;

/**
 * Interface to implement the service responsible for URL statistics management
 * (CRUD operations on URL statistics records).
 *
 * @author Anton Pelykh <anton.pelykh.dev@gmail.com>
 */
interface UrlStatisticsCrudServiceInterface
{
    /**
     * @param int $id The statistic record identifier.
     *
     * @return Statistic|null
     */
    public function get(int $id): ?Statistic;

    /**
     * Returns the list of the statistic records.
     *
     * @param Criteria $criteria
     *
     * @return Collection
     */
    public function getList(Criteria $criteria): Collection;

    /**
     * @param Statistic $statistic The statistic record which need to be created.
     */
    public function create(Statistic $statistic): void;

    /**
     * @param Statistic $statistic The statistic record which need to be updated.
     */
    public function update(Statistic $statistic): void;

    /**
     * @param Statistic $statistic The statistic record which need to be deleted.
     */
    public function delete(Statistic $statistic): void;
}
