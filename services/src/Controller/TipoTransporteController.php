<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class TipoTransporteController extends AbstractController
{
    /**
     * @Route("/tipo/transporte", name="app_tipo_transporte")
     */
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/TipoTransporteController.php',
        ]);
    }
}
