<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class CsPuntoLsController extends AbstractController
{
    /**
     * @Route("/cs/punto/ls", name="app_cs_punto_ls")
     */
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/CsPuntoLsController.php',
        ]);
    }
}
