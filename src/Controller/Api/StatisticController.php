<?php

declare(strict_types = 1);

namespace App\Controller\Api;

use App\Dto\Assembler\StatisticAssembler;
use App\Entity;
use App\Service\Url\Exception\UrlNotFoundException;
use App\Service\Url\UrlServiceInterface;
use App\Service\Url\UrlStatisticsCrudServiceInterface;
use Doctrine\Common\Collections\Criteria;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * The API endpoints required to receive the URL click statistics.
 *
 * @author Anton Pelykh <anton.pelykh.dev@gmail.com>
 *
 * @Route(path="/api/v1")
 */
class StatisticController
{
    /**
     * @var UrlServiceInterface
     */
    private $urlService;
    /**
     * @var UrlStatisticsCrudServiceInterface
     */
    private $urlStatisticsCrudService;
    /**
     * @var StatisticAssembler
     */
    private $statisticAssembler;
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * StatisticController constructor.
     *
     * @param SerializerInterface $serializer
     * @param UrlServiceInterface $urlService
     * @param UrlStatisticsCrudServiceInterface $urlStatisticsCrudService
     * @param StatisticAssembler $statisticAssembler
     */
    public function __construct(
        SerializerInterface $serializer,
        UrlServiceInterface $urlService,
        UrlStatisticsCrudServiceInterface $urlStatisticsCrudService,
        StatisticAssembler $statisticAssembler
    ) {
        $this->serializer = $serializer;
        $this->urlService = $urlService;
        $this->urlStatisticsCrudService = $urlStatisticsCrudService;
        $this->statisticAssembler = $statisticAssembler;
    }

    /**
     * Returns the detailed URL statistics.
     *
     * @param Request $request
     * @param string $shortId
     *
     * @return JsonResponse
     *
     * @Route(
     *     path="/urls/{shortId}/stats",
     *     name="api_get_url_stats",
     * )
     */
    public function get(Request $request, string $shortId): JsonResponse
    {
        try {
            $shortUrl = new Entity\ShortUrl($shortId);
            $url = $this->urlService->makeUrl($shortUrl);
        } catch (UrlNotFoundException $e) {
            throw new NotFoundHttpException();
        }

        $criteria = Criteria::create()
            ->where(Criteria::expr()->eq('url', $url));
        $collection = $this->urlStatisticsCrudService->getList($criteria);

        $responseDto = $this->statisticAssembler->writeDto($url, $collection);

        return new JsonResponse(
            $this->serializer->serialize(
                $responseDto,
                'json'
            ),
            Response::HTTP_OK,
            [],
            true
        );
    }
}
