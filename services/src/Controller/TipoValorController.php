<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Service\SerializerService;
use App\Service\AuthService;

use App\Entity\TipoValor;

class TipoValorController extends AbstractController {

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
  
      $repository = $this->getDoctrine()->getRepository(TipoValor::class);
      $typeValue = $repository->findAll();
      
  
      if (!$typeValue) {
        return $this->json([
          'error' => "TIPO_VALOR_NOT_FOUND"
        ]);
      }
  
      $serializer = $this->serializerService->getSerializer();
      $data = $serializer->serialize($typeValue, 'json');
  
      return new Response($data);
    }
    
}
