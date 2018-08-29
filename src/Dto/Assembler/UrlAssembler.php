<?php

declare(strict_types = 1);

namespace App\Dto\Assembler;

use App\Dto\Request;
use App\Dto\Response;
use App\Entity;

/**
 * Implementation of assembler to handle DTOs related to the short URL creation.
 *
 * @author Anton Pelykh <anton.pelykh.dev@gmail.com>
 */
class UrlAssembler
{
    public function writeEntity(Request\Url $dto): Entity\Url
    {
        $entity = new Entity\Url();
        $entity
            ->setLongUrl($dto->getLongUrl())
            ->setExpiredAt($dto->getExpiredAt());

        return $entity;
    }

    public function writeDto(Entity\Url $urlEntity, Entity\ShortUrl $shortUrlEntity): Response\Url
    {
        $dto = new Response\Url();
        $dto
            ->setShortUrl($shortUrlEntity->getShortUrl())
            ->setLongUrl($urlEntity->getLongUrl())
            ->setExpiredAt($urlEntity->getExpiredAt())
            ->setCreatedAt($urlEntity->getCreatedAt());

        return $dto;
    }
}
