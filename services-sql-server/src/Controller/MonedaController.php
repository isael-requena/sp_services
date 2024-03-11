<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\SerializerService;
use App\Service\AuthService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class MonedaController extends AbstractController
{
    public function __construct(SerializerService $serializerService) {
      $this->serializerService = $serializerService;
    }

    public function getAllMoneda(): Response{
      $request = Request::createFromGlobals();
        
        /*$decoded = $this->authService->validateRequest($request);
        if (gettype($decoded) == 'array' && isset($decoded['error'])) {
            return $this->json($decoded);
        }*/

        $connection = $this->getDoctrine()->getConnection();
        $sql = 'SELECT * FROM moneda';
        $prepare = $connection->query($sql);
        $resultSet = $prepare->fetchAll();
    
        if (!$resultSet) {
        return $this->json([
            'error' => "NOT_FOUND"
        ]);
        }
    
        $serializer = $this->serializerService->getSerializer();
        $data = $serializer->serialize($resultSet, 'json');
    
        return new Response($data);
    }
}
