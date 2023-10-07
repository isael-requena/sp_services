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

use App\Entity\LogBdm;

class LogBdmController extends AbstractController {

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

    $repository = $this->getDoctrine()->getRepository(LogBdm::class);
    $logBdm = $repository->findAll();
    

    if (!$logBdm) {
      return $this->json([
        'error' => "LOG_NOT_FOUND"
      ]);
    }

    $serializer = $this->serializerService->getSerializer();
    $data = $serializer->serialize($logBdm, 'json');

    return new Response($data);
  }

  public function insert(): Response{

    $request = Request::createFromGlobals();

    /*$decoded = $this->authService->validateRequest($request);
    if (gettype($decoded) == 'array' && isset($decoded['error'])) {
      return $this->json($decoded);
    }*/

    $requestBody = json_decode($request->getContent(), true);

    $log = new LogBdm();
    $log->setUsuarioCreacion($requestBody['username']);
    $date = new \DateTime('now');
    $dateModify = $date->format('Y-m-d H:i:s');
    $log->setFecha($dateModify);
    $log->setEstatusRegistro(1);
    $log->setDescripcion($requestBody['descripcion']);
    $log->setListaRecorrido($requestBody['id_lista_recorrido']);
    
    $entityManager = $this->getDoctrine()->getManager();

    $entityManager->persist($log);
    $entityManager->flush();
    $message = 'SUCCESS';
    
    return $this->json([
      'message' => $message
    ]);
    
  }
}
