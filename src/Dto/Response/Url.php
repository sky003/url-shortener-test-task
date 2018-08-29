<?php

declare(strict_types = 1);

namespace App\Dto\Response;

/**
 * @author Anton Pelykh <anton.pelykh.dev@gmail.com>
 */
class Url
{
    /**
     * @var string
     */
    private $shortUrl;
    /**
     * @var string
     */
    private $longUrl;
    /**
     * @var \DateTime
     */
    private $expiredAt;
    /**
     * @var \DateTimeImmutable
     */
    private $createdAt;

    /**
     * @return string
     */
    public function getShortUrl(): string
    {
        return $this->shortUrl;
    }

    /**
     * @param string $shortUrl
     *
     * @return self
     */
    public function setShortUrl(string $shortUrl): Url
    {
        $this->shortUrl = $shortUrl;

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
}
