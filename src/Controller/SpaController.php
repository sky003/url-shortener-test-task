<?php

declare(strict_types = 1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * The controller responsible for frontend SPA (single page application).
 *
 * @author Anton Pelykh <anton.pelykh.dev@gmail.com>
 */
class SpaController extends Controller
{
    /**
     * Renders SPA.
     *
     * The frontend SPA handles the endpoints below. Frontend SPA responsible for UI to
     * create a new short URL, and UI to view the statistics.
     *
     * @return Response
     *
     * @Route(
     *     path="/",
     *     name="create_url",
     * )
     * @Route(
     *     path="/{short_id}/stats",
     *     name="view_url_stats",
     * )
     */
    public function index(): Response
    {
        return $this->render('spa/index.html.twig');
    }
}
