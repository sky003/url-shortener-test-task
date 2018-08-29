<?php

declare(strict_types = 1);

namespace App\Dto\Response;

use Doctrine\Common\Collections\Collection;

/**
 * @author Anton Pelykh <anton.pelykh.dev@gmail.com>
 */
class Statistic
{
    /**
     * @var string
     */
    private $longUrl;
    /**
     * @var int The total clicks number.
     */
    private $clicks;
    /**
     * @var Collection
     */
    private $clientStatistics;

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
    public function setLongUrl(string $longUrl): Statistic
    {
        $this->longUrl = $longUrl;

        return $this;
    }

    /**
     * @return int
     */
    public function getClicks(): int
    {
        return $this->clicks;
    }

    /**
     * @param int $clicks
     *
     * @return self
     */
    public function setClicks(int $clicks): Statistic
    {
        $this->clicks = $clicks;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getClientStatistics(): Collection
    {
        return $this->clientStatistics;
    }

    /**
     * @param Collection $clientStatistics
     *
     * @return self
     */
    public function setClientStatistics(Collection $clientStatistics): Statistic
    {
        $this->clientStatistics = $clientStatistics;

        return $this;
    }
}
