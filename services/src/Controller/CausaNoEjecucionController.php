<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Service\SerializerService;
use App\Service\AuthService;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

use App\Entity\CausaNoEjecucion;

class CausaNoEjecucionController extends AbstractController {

    private $serializerService;

    public function __construct(SerializerService $serializerService, AuthService $authService) {
        $this->serializerService = $serializerService;
        $this->authService = $authService;
    }

    public function getAll(): Response{

      /* $request = Request::createFromGlobals();
  
      $decoded = $this->authService->validateRequest($request);
      if (gettype($decoded) == 'array' && isset($decoded['error'])) {
          return $this->json($decoded);
      }*/
  
      $repository = $this->getDoctrine()->getRepository(CausaNoEjecucion::class);
      $users = $repository->findAll();
      
  
      if (!$users) {
        return $this->json([
          'error' => "EVENTS_NOT_FOUND"
        ]);
      }
  
      $serializer = $this->serializerService->getSerializer();
      $data = $serializer->serialize($users, 'json');
  
      return new Response($data);
    }
    
}
