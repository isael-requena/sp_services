<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request; 
use App\Service\SerializerService;
use App\Service\AuthService;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\TrackingMaestro;

class TrackingMaestroController extends AbstractController {
    
    private $serializerService;

    public function __construct(SerializerService $serializerService, AuthService $authService) {
        $this->serializerService = $serializerService;
        $this->authService = $authService;
    }

    public function getMasterTracking() : Response {

        $request = Request::createFromGlobals();
    
        /*$decoded = $this->authService->validateRequest($request);
    
        if (gettype($decoded) == 'array' && isset($decoded['error'])) {
          return $this->json($decoded);
        }*/
    
        $requestBody = json_decode($request->getContent(), true);
        
        $repository = $this->getDoctrine()->getRepository(TrackingMaestro::class);
        $tracking = $repository->findBy([
            'codCliente' => $requestBody['num_cli'],
            'comprobante' => $requestBody['comprobante']
        ]);

        if (!$tracking) {
            return $this->json([
              'message' => "TRACKING_MAESTRO_NO_ENCONTRADO"
            ]);
        }

        $serializer = $this->serializerService->getSerializer();
        $data = $serializer->serialize($tracking, 'json');

        return new Response($data);
    
    }
}
