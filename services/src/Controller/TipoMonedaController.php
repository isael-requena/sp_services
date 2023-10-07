<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Service\SerializerService;
use App\Service\AuthService;

use App\Entity\TipoMoneda;

class TipoMonedaController extends AbstractController {

    private $serializerService;

    public function __construct(SerializerService $serializerService, AuthService $authService) {
        $this->serializerService = $serializerService;
        $this->authService = $authService;
    }
   
    public function getAll(): Response{

      $request = Request::createFromGlobals();
  
      $decoded = $this->authService->validateRequest($request);
      if (gettype($decoded) == 'array' && isset($decoded['error'])) {
          return $this->json($decoded);
      }
  
      $repository = $this->getDoctrine()->getRepository(TipoMoneda::class);
      $typeMoney = $repository->findAll();
      
  
      if (!$typeMoney) {
        return $this->json([
          'error' => "TIPO_MONEDA_NOT_FOUND"
        ]);
      }
  
      $serializer = $this->serializerService->getSerializer();
      $data = $serializer->serialize($typeMoney, 'json');
  
      return new Response($data);
    }
}
