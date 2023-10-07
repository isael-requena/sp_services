<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Service\SerializerService;
use App\Service\AuthService;

use App\Entity\Estatus;
use App\Entity\ComprobanteServicio;
use App\Entity\ListaRecorrido;
use App\Entity\PuntoLr;

class ApiComprobanteServicioController extends AbstractController {

  public function __construct(SerializerService $serializerService, AuthService $authService) {
    $this->serializerService = $serializerService;
    $this->authService = $authService;
  }

  public function updateReceiptById() : Response {
    $request = Request::createFromGlobals();

    $decoded = $this->authService->validateRequest($request);

    if (gettype($decoded) == 'array' && isset($decoded['error'])) {
      return $this->json($decoded);
    }

    $requestBody = json_decode($request->getContent(), true);

    $repository = $this->getDoctrine()->getRepository(ComprobanteServicio::class);
    $comprobante = $repository->findOneBy([
      'codCs' => $requestBody['code']
    ]);
  
    if (!$comprobante) {
      return $this->json([
          'error' => 'COMPROBANTE_NOT_FOUND_ERROR'
      ]);
    }
    

    if (isset($requestBody['status'])) {
      $repository = $this->getDoctrine()->getRepository(Estatus::class);
      $status = $repository->findOneBy([
        'idEstatus' => $requestBody['status']
      ]);

      if (!$status) {
        return $this->json([
          'error' => self::STATUS_NOT_FOUND_ERROR
        ]);
      }

      $comprobante->setFkEstatus($status);
      $date = new \DateTime('now');
      $dateModify = $date->format('Y-m-d H:i:s');
      $comprobante->setFecEstatus($date);
    }

    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->persist($comprobante);
    $entityManager->flush();

    return $this->json([
      'message' => 'SUCCESS'
    ]);

  }

  public function getNewPointList($id) : Response {
    $request = Request::createFromGlobals();

    $decoded = $this->authService->validateRequest($request);

    if (gettype($decoded) == 'array' && isset($decoded['error'])) {
      return $this->json($decoded);
    }

    $requestBody = json_decode($request->getContent(), true);

    /*$repositoryList = $this->getDoctrine()->getRepository(ListaRecorrido::class);

    $list = $repositoryList->findOneBy([
      'idListaRecorrido' => $id
    ]);

    if (!$list) {
      return $this->json([
        'error' => 'LISTA_NOT_FOUND'
      ]);
    }*/

    $repository = $this->getDoctrine()->getRepository(PuntoLr::class);

    $receipts = $repository->findBy([
      'fkListaRecorrido' => $id,
      'fkEstatus' => 3
    ]);

    if (!$receipts) {
      return $this->json([
        'message' => 'NO_NEW_POINTS'
      ]);
    }

    $serializer = $this->serializerService->getSerializer();
    $data = $serializer->serialize($receipts, 'json');

    return new Response($data);
  }
}
