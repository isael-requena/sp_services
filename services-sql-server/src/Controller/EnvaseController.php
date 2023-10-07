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
use App\Entity\Envase;
use App\Entity\ComprobanteServicio;
use App\Entity\Estatus;

class EnvaseController extends AbstractController {

    private $serializerService;

    public function __construct(SerializerService $serializerService, AuthService $authService) {
        $this->serializerService = $serializerService;
        $this->authService = $authService;
    }

    public function insertMultiplePackings(){

        $request = Request::createFromGlobals();

        $decoded = $this->authService->validateRequest($request);
        if (gettype($decoded) == 'array' && isset($decoded['error'])) {
            return $this->json($decoded);
        }

        $requestBody = json_decode($request->getContent(), true);

        $repositoryReceipt = $this->getDoctrine()->getRepository(ComprobanteServicio::class);
        $receipt = $repositoryReceipt->findOneBy([
            'codCs' => $requestBody['code']
        ]);

        $repositoryStatus = $this->getDoctrine()->getRepository(Estatus::class);
        $status = $repositoryStatus->findOneBy([
            'idEstatus' => 16
        ]);

        foreach ($requestBody['packaging'] as $key => $value) {

            $packing = new Envase();
            $date = new \DateTime('now');
            $dateModify = $date->format('Y-m-d H:i:s');
            $packing->setCodEnvase($value['code']);
            $packing->setFecEscaneo($dateModify);
            $packing->setUsuarioCreacion($requestBody['username']);
            $packing->setUsuarioModificacion($requestBody['username']);
            $packing->setRegistroManual($value['manual']);
            $packing->setEstatusRegistro(1);
            $packing->setFecEstatus($dateModify);
            $packing->setFecCreacion($dateModify);
            $packing->setFecModificacion($dateModify);
            $packing->setFkComprobanteServicio($receipt);
            $packing->setFkEstatus($status);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($packing);
            $entityManager->flush();
            
        }

        $message = 'SUCCESS';
        
        return $this->json([
            'message' => $message
        ]);

    }

    
}
