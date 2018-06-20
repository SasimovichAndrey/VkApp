<?php
/**
 * Created by PhpStorm.
 * User: ordiday
 * Date: 20.06.2018
 * Time: 22:50
 */

namespace App\Controller;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class TestController
{
    /**
     * @Route("/test", name="test_json_response")
     */
    public function testAction()
    {
        return new JsonResponse(null);
    }
}