<?php

declare(strict_types = 1);

namespace App\Service\Url;

use App\Entity\Url;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;

/**
 * Interface to implement the service responsible for URLs management (CRUD operations on URLs).
 *
 * This service doesn't care about how URL should be shortened. Right now the service just saving
 * the long version or URL, and URL metadata (like an expiration time, and etc).
 *
 * @author Anton Pelykh <anton.pelykh.dev@gmail.com>
 */
interface UrlCrudServiceInterface
{
    /**
     * @param int $id The URL identifier.
     *
     * @return Url|null
     */
    public function get(int $id): ?Url;

    /**
     * Returns the list of URLs.
     *
     * @param Criteria $criteria
     *
     * @return Collection
     */
    public function getList(Criteria $criteria): Collection;

    /**
     * @param Url $url The URL which need to be created.
     */
    public function create(Url $url): void;

    /**
     * @param Url $url The URL which need to be updated.
     */
    public function update(Url $url): void;

    /**
     * @param Url $url The URL which need to be deleted.
     */
    public function delete(Url $url): void;
}
