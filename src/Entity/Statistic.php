<?php

declare(strict_types = 1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * The entity which is represents URL statistic.
 *
 * @author Anton Pelykh <anton.pelykh.dev@gmail.com>
 *
 * @ORM\Entity()
 * @ORM\Table(name="statistic")
 * @ORM\HasLifecycleCallbacks()
 */
class Statistic
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
     * @var Url
     *
     * @ORM\ManyToOne(targetEntity="Url", inversedBy="statistics")
     * @ORM\JoinColumn(name="url_id")
     */
    private $url;
    /**
     * @var string The value of `User-Agent` header. But in the real world need to be decided what storage should be
     * used for this data, because RDBMS not seems to be the best solution. Or in the case RDBMS usage, this probably
     * should be normalized, or divided into a few columns, like browser, platform, and etc. This will provide better
     * opportunities for aggregation.
     *
     * @ORM\Column(type="text", name="user_agent", nullable=true)
     */
    private $userAgent;
    /**
     * @var string The ISO 3166-1 (alpha-2) country code. The same thing as with {@see Statistic::$userAgent}. That's
     * not the best way to store this value, but it's enough for the test task.
     *
     * @ORM\Column(type="string", length=2)
     */
    private $country;
    /**
     * @var string The value of `Referer` header.
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $referer;
    /**
     * @var \DateTimeImmutable
     *
     * @ORM\Column(type="datetime_immutable", name="created_at")
     */
    private $createdAt;

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
    public function setId(int $id): Statistic
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return Url
     */
    public function getUrl(): Url
    {
        return $this->url;
    }

    /**
     * @param Url $url
     *
     * @return self
     */
    public function setUrl(Url $url): Statistic
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return string
     */
    public function getUserAgent(): ?string
    {
        return $this->userAgent;
    }

    /**
     * @param string $userAgent
     *
     * @return self
     */
    public function setUserAgent(?string $userAgent): Statistic
    {
        $this->userAgent = $userAgent;

        return $this;
    }

    /**
     * @return string
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @param string $country
     *
     * @return self
     */
    public function setCountry(?string $country): Statistic
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return string
     */
    public function getReferer(): ?string
    {
        return $this->referer;
    }

    /**
     * @param string $referer
     *
     * @return self
     */
    public function setReferer(?string $referer): Statistic
    {
        $this->referer = $referer;

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
    public function setCreatedAt(\DateTimeImmutable $createdAt): Statistic
    {
        $this->createdAt = $createdAt;

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
