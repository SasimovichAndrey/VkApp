<?php
/**
 * Created by PhpStorm.
 * User: ordiday
 * Date: 20.06.2018
 * Time: 22:38
 */

namespace App\Controller;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepageAction()
    {
        return new JsonResponse(null, Response::HTTP_FORBIDDEN);
    }

}