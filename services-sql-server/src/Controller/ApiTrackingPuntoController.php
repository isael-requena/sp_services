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
use App\Entity\Punto;
use App\Entity\TrackingPunto;
use App\Entity\TrackingCs;
use App\Entity\ComprobanteServicio;

class ApiTrackingPuntoController extends AbstractController {

  public function __construct(SerializerService $serializerService, AuthService $authService) {
    $this->serializerService = $serializerService;
    $this->authService = $authService;
  }

  public function insertTrackingPoint() : Response {

    $request = Request::createFromGlobals();

    $decoded = $this->authService->validateRequest($request);

    if (gettype($decoded) == 'array' && isset($decoded['error'])) {
      return $this->json($decoded);
    }

    $requestBody = json_decode($request->getContent(), true);

    $trackingPoint = new TrackingPunto();

    $repositoryPoint = $this->getDoctrine()->getRepository(Punto::class);

    $punto = $repositoryPoint->findOneBy([
      'idPunto' => $requestBody['id']
    ]);
  
    if (!$punto) {
      return $this->json([
        'error' => 'PUNTO_NOT_FOUND_ERROR'
      ]);
    }
    $trackingPoint->setFkPunto($punto);
    $date = new \DateTime('now');
    $dateModify = $date->format('Y-m-d H:i:s');
    $trackingPoint->setFecCreacion($dateModify);
    
    if (isset($requestBody['status'])) {
      $repository = $this->getDoctrine()->getRepository(Estatus::class);
      $status = $repository->findOneBy([
        'idEstatus' => $requestBody['status']
      ]);

      if (!$status) {
        return $this->json([
          'error' => 'STATUS_NOT_FOUND_ERROR'
        ]);
      }
      $date = new \DateTime('now');
      $dateModify = $date->format('Y-m-d H:i:s');
      $trackingPoint->setFecEstatus($dateModify);
      $trackingPoint->setFkEstatus($status);
      
    }

    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->persist($trackingPoint);
    $entityManager->flush();

    return $this->json([
      'message' => 'SUCCESS'
    ]);

  }

  public function insertTrackingCs() : Response {

    $request = Request::createFromGlobals();

    $decoded = $this->authService->validateRequest($request);

    if (gettype($decoded) == 'array' && isset($decoded['error'])) {
      return $this->json($decoded);
    }

    $requestBody = json_decode($request->getContent(), true);

    $trackingCs = new TrackingCs();

    $repositoryReceipt = $this->getDoctrine()->getRepository(ComprobanteServicio::class);

    $receipt = $repositoryReceipt->findOneBy([
      'codCs' => $requestBody['code']
    ]);
  
    if (!$receipt) {
      return $this->json([
        'error' => 'COMPROBANTE_NOT_FOUND_ERROR'
      ]);
    }
    $trackingCs->setFkComprobanteServicio($receipt);
    $trackingCs->setFecCreacion(new \DateTime('now'));
    
    if (isset($requestBody['status'])) {
      $repository = $this->getDoctrine()->getRepository(Estatus::class);
      $status = $repository->findOneBy([
        'idEstatus' => $requestBody['status']
      ]);

      if (!$status) {
        return $this->json([
          'error' => 'STATUS_NOT_FOUND_ERROR'
        ]);
      }
      $trackingCs->setFecEstatus(new \DateTime('now'));
      $trackingCs->setFkEstatus($status);
      
    }

    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->persist($trackingCs);
    $entityManager->flush();

    return $this->json([
      'message' => 'SUCCESS'
    ]);

  }

  
  public function getNewPointList() : Response {
    $request = Request::createFromGlobals();

    $decoded = $this->authService->validateRequest($request);

    if (gettype($decoded) == 'array' && isset($decoded['error'])) {
      return $this->json($decoded);
    }

    $requestBody = json_decode($request->getContent(), true);

    $repositoryList = $this->getDoctrine()->getRepository(CsPuntoLr::class);

    $list = $repositoryList->findOneBy([
      'idListaRecorrido' => $requestBody['id']
    ]);

    if (!$list) {
      return $this->json([
        'error' => 'LISTA_NOT_FOUND'
      ]);
    }

    $repository = $this->getDoctrine()->getRepository(CsPuntoLr::class);

    $receipts = $repository->findOneBy([
      'fkListaRecorrido' => $list
    ]);

    if (!$receipts) {
      return $this->json([
        'message' => 'COMPROBANTE_NOT_FOUND'
      ]);
    }
  }
  
}
