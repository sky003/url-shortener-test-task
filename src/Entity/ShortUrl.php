<?php

declare(strict_types = 1);

namespace App\Entity;

/**
 * The entity which represents a short URL.
 *
 * @author Anton Pelykh <anton.pelykh.dev@gmail.com>
 */
class ShortUrl
{
    /**
     * @var string
     */
    public $id;
    /**
     * @var string
     */
    public $shortUrl;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     *
     * @return self
     */
    public function setId(string $id): ShortUrl
    {
        $this->id = $id;

        return $this;
    }

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
    public function setShortUrl(string $shortUrl): ShortUrl
    {
        $this->shortUrl = $shortUrl;

        return $this;
    }
}
