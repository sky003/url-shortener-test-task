<?php

declare(strict_types = 1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * The entity which represents URL.
 *
 * @author Anton Pelykh <anton.pelykh.dev@gmail.com>
 *
 * @ORM\Entity()
 * @ORM\Table(name="url")
 * @ORM\HasLifecycleCallbacks()
 */
class Url
{
    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var string
     *
     * @ORM\Column(type="text", name="long_url")
     */
    private $longUrl;
    /**
     * @var \DateTime The time when the short link will be expired.
     *
     * @ORM\Column(type="datetime", name="expired_at", nullable=true)
     */
    private $expiredAt;
    /**
     * @var \DateTimeImmutable
     *
     * @ORM\Column(type="datetime_immutable", name="created_at")
     */
    private $createdAt;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="Statistic", mappedBy="url", cascade={"persist", "remove"})
     */
    private $statistics;

    /**
     * Url constructor.
     */
    public function __construct()
    {
        $this->statistics = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return self
     */
    public function setId(int $id): Url
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getLongUrl(): string
    {
        return $this->longUrl;
    }

    /**
     * @param string $longUrl
     *
     * @return self
     */
    public function setLongUrl(string $longUrl): Url
    {
        $this->longUrl = $longUrl;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getExpiredAt(): ?\DateTime
    {
        return $this->expiredAt;
    }

    /**
     * @param \DateTime $expiredAt
     *
     * @return self
     */
    public function setExpiredAt(?\DateTime $expiredAt): Url
    {
        $this->expiredAt = $expiredAt;

        return $this;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeImmutable $createdAt
     *
     * @return self
     */
    public function setCreatedAt(\DateTimeImmutable $createdAt): Url
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getStatistics(): Collection
    {
        return $this->statistics;
    }

    /**
     * @param Collection $statistics
     *
     * @return self
     */
    public function setStatistics(Collection $statistics): Url
    {
        $this->statistics = $statistics;

        return $this;
    }

    /**
     * @ORM\PrePersist()
     */
    public function onPrePersist(): void
    {
        $this->createdAt = new \DateTimeImmutable('now');
    }
}
