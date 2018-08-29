<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Entity\ShortUrl;
use App\Service\Url\Exception\UrlNotFoundException;
use App\Service\Url\UrlServiceInterface;
use App\Service\Url\UrlStatisticsServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @author Anton Pelykh <anton.pelykh.dev@gmail.com>
 */
class UrlController extends Controller
{
    /**
     * @var UrlServiceInterface
     */
    private $urlService;
    /**
     * @var UrlStatisticsServiceInterface
     */
    private $statisticsService;

    /**
     * UrlController constructor.
     *
     * @param UrlServiceInterface $urlService
     * @param UrlStatisticsServiceInterface $statisticsService
     */
    public function __construct(UrlServiceInterface $urlService, UrlStatisticsServiceInterface $statisticsService)
    {
        $this->urlService = $urlService;
        $this->statisticsService = $statisticsService;
    }

    /**
     * Makes a redirect to long URL.
     *
     * @param Request $request
     * @param string $shortId
     *
     * @return Response
     *
     * @Route(
     *     path="/{shortId}",
     *     name="open_url",
     * )
     */
    public function open(Request $request, string $shortId): Response
    {
        $shortUrlEntity = new ShortUrl($shortId);

        try {
            $urlEntity = $this->urlService->makeUrl($shortUrlEntity);
        } catch (UrlNotFoundException $e) {
            throw new NotFoundHttpException();
        }

        $this->statisticsService->logUrlOpen($urlEntity, $request);

        return new RedirectResponse($urlEntity->getLongUrl());
    }
}
