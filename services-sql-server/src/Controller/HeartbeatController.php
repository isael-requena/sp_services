<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class HeartbeatController extends AbstractController
{
    
    public function index(): JsonResponse
    {
        return $this->json([
            'code' => 200,
            'message' => 'SERVER OK'
        ]);
    }
}
