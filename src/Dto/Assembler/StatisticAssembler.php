<?php

declare(strict_types = 1);

namespace App\Dto\Assembler;

use App\Dto\Response;
use App\Entity;
use Doctrine\Common\Collections\Collection;

/**
 * Implementation of assembler to handle DTOs related to the URL click statistics.
 *
 * @author Anton Pelykh <anton.pelykh.dev@gmail.com>
 */
class StatisticAssembler
{
    public function writeDto(Entity\Url $urlEntity, Collection $statisticEntityCollection): Response\Statistic
    {
        $statistic = new Response\Statistic();
        $statistic
            ->setLongUrl($urlEntity->getLongUrl())
            ->setClicks(\count($statisticEntityCollection)) // Number of the statistic records is equals to clicks.
            ->setClientStatistics(
                $statisticEntityCollection->map(function (Entity\Statistic $entity) {
                    $dto = new Response\ClientStatistic();
                    $dto
                        ->setId($entity->getId())
                        ->setUserAgent($entity->getUserAgent())
                        ->setReferer($entity->getReferer())
                        ->setCountry($entity->getCountry())
                        ->setCreatedAt($entity->getCreatedAt());

                    return $dto;
                })
            );

        return $statistic;
    }
}
