<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class TipoCausaNoEjecucionController extends AbstractController
{
    /**
     * @Route("/tipo/causa/no/ejecucion", name="app_tipo_causa_no_ejecucion")
     */
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/TipoCausaNoEjecucionController.php',
        ]);
    }
}
