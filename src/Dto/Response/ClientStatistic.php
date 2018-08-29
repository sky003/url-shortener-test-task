<?php

declare(strict_types = 1);

namespace App\Dto\Response;

/**
 * @author Anton Pelykh <anton.pelykh.dev@gmail.com>
 */
class ClientStatistic
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $userAgent;
    /**
     * @var string
     */
    private $country;
    /**
     * @var string
     */
    private $referer;
    /**
     * @var \DateTimeImmutable
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
    public function setId(int $id): ClientStatistic
    {
        $this->id = $id;

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
    public function setUserAgent(?string $userAgent): ClientStatistic
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
    public function setCountry(?string $country): ClientStatistic
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
    public function setReferer(?string $referer): ClientStatistic
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
    public function setCreatedAt(\DateTimeImmutable $createdAt): ClientStatistic
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
