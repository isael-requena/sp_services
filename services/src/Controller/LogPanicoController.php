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

use App\Entity\LogPanico;

class LogPanicoController extends AbstractController {

    private $serializerService;

    public function __construct(SerializerService $serializerService, AuthService $authService) {
        $this->serializerService = $serializerService;
        $this->authService = $authService;
    }

    public function register(){

        $request = Request::createFromGlobals();

        $decoded = $this->authService->validateRequest($request);
        if (gettype($decoded) == 'array' && isset($decoded['error'])) {
            return $this->json($decoded);
        }

        $requestBody = json_decode($request->getContent(), true);

        $log = new LogPanico();
        $log->setFecCreacion(new \DateTime('now'));
        $log->setListaRecorrido($requestBody['id_tour_list']);
        $log->setFkPuntoLr($requestBody['id']);
        $log->setEstatusPunto($requestBody['status']);
        //$log->setFecPunto(new \DateTime($requestBody['date']));
        $log->setFecPunto(new \DateTime('now'));
        $log->setUsuarioCreacion($requestBody['username']);
        $log->setEstatusRegistro(1);
        
        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->persist($log);
        $entityManager->flush();
        $message = 'SUCCESS';
        
        
        return $this->json([
            'message' => $message
        ]);

    }
    
}
