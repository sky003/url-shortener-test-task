<?php

declare(strict_types = 1);

namespace App\Controller\Api;

use App\Dto\Assembler\UrlAssembler;
use App\Dto;
use App\Service\Url\UrlServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * The API endpoints required to create a short URL.
 *
 * @author Anton Pelykh <anton.pelykh.dev@gmail.com>
 *
 * @Route(path="/api/v1")
 */
class UrlController
{
    /**
     * @var SerializerInterface
     */
    private $serializer;
    /**
     * @var ValidatorInterface
     */
    private $validator;
    /**
     * @var UrlAssembler
     */
    private $urlAssembler;
    /**
     * @var UrlServiceInterface
     */
    private $urlService;

    public function __construct(
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        UrlAssembler $urlAssembler,
        UrlServiceInterface $urlService
    ) {
        $this->serializer = $serializer;
        $this->validator = $validator;
        $this->urlAssembler = $urlAssembler;
        $this->urlService = $urlService;
    }

    /**
     * Creates a new short URL.
     *
     * @param Request $request
     *
     * @return JsonResponse
     *
     * @Route(
     *     path="/urls",
     *     methods={"POST"},
     *     name="api_create_url",
     * )
     */
    public function create(Request $request): JsonResponse
    {
        /** @var Dto\Request\Url $requestDto */
        $requestDto = $this->serializer->deserialize(
            $request->getContent(),
            Dto\Request\Url::class,
            'json'
        );

        $errors = $this->validator->validate($requestDto);
        if (\count($errors) > 0) {
            throw new UnprocessableEntityHttpException();
        }

        $urlEntity = $this->urlAssembler->writeEntity($requestDto);

        $this->urlService->create($urlEntity);
        $shortUrlEntity = $this->urlService->makeShortUrl($urlEntity);

        $responseDto = $this->urlAssembler->writeDto($urlEntity, $shortUrlEntity);

        return new JsonResponse(
            $this->serializer->serialize(
                $responseDto,
                'json'
            ),
            Response::HTTP_CREATED,
            [],
            true
        );
    }
}
