<?php

declare(strict_types = 1);

namespace App\Dto\Request;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author Anton Pelykh <anton.pelykh.dev@gmail.com>
 */
class CreateShortUrl
{
    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Url()
     */
    private $longUrl;
    /**
     * @var \DateTime
     *
     * @Assert\Range(
     *     min="now",
     * )
     */
    private $expiredAt;

    /**
     * @return string
     */
    public function getLongUrl(): ?string
    {
        return $this->longUrl;
    }

    /**
     * @param string $longUrl
     *
     * @return self
     */
    public function setLongUrl(?string $longUrl): CreateShortUrl
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
    public function setExpiredAt(?\DateTime $expiredAt): CreateShortUrl
    {
        $this->expiredAt = $expiredAt;

        return $this;
    }

}
