<?php

declare(strict_types = 1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @author Anton Pelykh <anton.pelykh.dev@gmail.com>
 */
class UrlController extends Controller
{
    /**
     * Create a new URL.
     *
     * @param Request $request
     *
     * @return Response
     *
     * @Route(
     *     path="/",
     *     name="create_url",
     * )
     */
    public function create(Request $request): Response
    {
        return $this->render('url/create.html.twig');
    }

    /**
     * Makes a redirect to long URL.
     *
     * @param Request $request
     *
     * @return Response
     *
     * @Route(
     *     path="/{short_id}",
     *     name="open_url",
     * )
     */
    public function open(Request $request): Response
    {
        return new Response();
    }
}
