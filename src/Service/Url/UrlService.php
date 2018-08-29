<?php

declare(strict_types = 1);

namespace App\Service\Url;

use App\Entity\ShortUrl;
use App\Entity\Url;
use App\Service\Url\Exception\UrlNotFoundException;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManagerInterface;
use Hashids\Hashids;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * The default implementation of url service.
 *
 * @author Anton Pelykh <anton.pelykh.dev@gmail.com>
 */
class UrlService implements UrlServiceInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;
    /**
     * @var Hashids
     */
    private $hashids;

    /**
     * UrlService constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param UrlGeneratorInterface $urlGenerator
     * @param Hashids $hashids
     */
    public function __construct(EntityManagerInterface $entityManager, UrlGeneratorInterface $urlGenerator, Hashids $hashids)
    {
        $this->entityManager = $entityManager;
        $this->urlGenerator = $urlGenerator;
        $this->hashids = $hashids;
    }

    /**
     * @param int $id The URL identifier.
     *
     * @return Url|null
     */
    public function get(int $id): ?Url
    {
        /** @var Url $entity */
        $entity = $this->entityManager->find(Url::class, $id);

        return $entity;
    }

    /**
     * Returns the list of URLs.
     *
     * @param Criteria $criteria
     *
     * @return Collection
     */
    public function getList(Criteria $criteria): Collection
    {
        throw new \BadMethodCallException(
            \sprintf('Method "%s" not implemented.', __METHOD__)
        );
    }

    /**
     * @param Url $url The URL which need to be created.
     */
    public function create(Url $url): void
    {
        $this->entityManager->persist($url);
        $this->entityManager->flush();
    }

    /**
     * @param Url $url The URL which need to be updated.
     */
    public function update(Url $url): void
    {
        throw new \BadMethodCallException(
            \sprintf('Method "%s" not implemented.', __METHOD__)
        );
    }

    /**
     * @param Url $url The URL which need to be deleted.
     */
    public function delete(Url $url): void
    {
        throw new \BadMethodCallException(
            \sprintf('Method "%s" not implemented.', __METHOD__)
        );
    }

    /**
     * Makes short and url-friendly identifier from provided url instance.
     *
     * @param Url $url
     *
     * @return ShortUrl
     */
    public function makeShortUrl(Url $url): ShortUrl
    {
        $shortId = $this->hashids->encode($url->getId());
        $shortAbsoluteUrl = $this->urlGenerator->generate(
            'open_url',
            ['shortId' => $shortId],
            UrlGeneratorInterface::ABSOLUTE_URL
        );

        $shortUrl = new ShortUrl();
        $shortUrl
            ->setId($shortId)
            ->setShortUrl($shortAbsoluteUrl);

        return $shortUrl;
    }

    /**
     * Makes the url instance from it's short identifier.
     *
     * @param ShortUrl $shortUrl
     *
     * @return Url
     * @throws UrlNotFoundException
     */
    public function makeUrl(ShortUrl $shortUrl): Url
    {
        $ids = $this->hashids->decode($shortUrl->getId());

        if (empty($ids)) {
            throw new UrlNotFoundException('Url can not be decoded.');
        }

        /** @var Url $url */
        $url = $this->entityManager->find(Url::class, $ids[0]);

        if (null === $url) {
            throw new UrlNotFoundException('Url can not be found in the database.');
        }

        return $url;
    }
}
