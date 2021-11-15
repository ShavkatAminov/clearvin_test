<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @package App\Controller
 * @Route("/", name="site")
 */
class SiteController extends BaseController
{
    /**
     * @Route(name="index", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->render("site/index.html.twig");
    }
}