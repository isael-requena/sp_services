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
use App\Entity\TrackingCs;
use App\Entity\Estatus;
use App\Entity\CsPuntoLr;
use App\Entity\PuntoLr;
use App\Entity\ComprobanteServicio;
use App\Entity\Envase;
use App\Entity\TipoMoneda;
use App\Entity\TipoValor;
use App\Entity\TipoOperacion;
use App\Entity\CausaNoEjecucion;


class TrackingCsController extends AbstractController {

    private $serializerService;

    public function __construct(SerializerService $serializerService, AuthService $authService) {
        $this->serializerService = $serializerService;
        $this->authService = $authService;
    }

    public function insertTrackingReceipt() : Response {

        $request = Request::createFromGlobals();
    
        $decoded = $this->authService->validateRequest($request);
    
        if (gettype($decoded) == 'array' && isset($decoded['error'])) {
          return $this->json($decoded);
        }
    
        $requestBody = json_decode($request->getContent(), true);
    
        $tracking = new TrackingCs();
        $tracking->setUsuarioCreacion($requestBody['username']);
        $tracking->setUsuarioModificacion($requestBody['username']);
        $tracking->setFecCreacion(new \DateTime('now'));
        $tracking->setFecModificacion(new \DateTime('now'));
        $tracking->setEstatusRegistro(1);
        
       
        $repository = $this->getDoctrine()->getRepository(Estatus::class);
        $status = $repository->findOneBy([
            'idEstatus' => $requestBody['status']
        ]);

        if (!$status) {
            return $this->json([
                'error' => "STATUS_NOT_FOUND_ERROR"
            ]);
        }

        $tracking->setFkEstatus($status);
        $tracking->setFecEstatus(new \DateTime('now'));

        $repositoryReceipt = $this->getDoctrine()->getRepository(ComprobanteServicio::class);
        $receipt = $repositoryReceipt->findOneBy([
            'codCs' => $requestBody['code']
        ]);

        if (!$receipt) {
            //pickup
            $receipt = new ComprobanteServicio();
            $receipt->setCorrelativo(null);
            $receipt->setCodCliente($requestBody['cod_client']);
            $receipt->setCodCs($requestBody['code']);
            $receipt->setDiceContener($requestBody['total']);
            $receipt->setCodOrigen($requestBody['origin']);
            $receipt->setCodDestino($requestBody['destiny']);
            $receipt->setUsuarioCreacion($requestBody['username']);
            $receipt->setUsuarioModificacion($requestBody['username']);
            $receipt->setEstatusRegistro(1);
            $receipt->setFecCreacion(new \DateTime('now'));
            $receipt->setFecModificacion(new \DateTime('now'));
            $receipt->setCantEnvases($requestBody['total_packing']);

            /*$repositoryStatus = $this->getDoctrine()->getRepository(Estatus::class);
            $status = $repositoryStatus->findOneBy([
                'idEstatus' => $requestBody['status']
            ]);

            if (!$status) {
                return $this->json([
                    'error' => "STATUS_NOT_FOUND_ERROR"
                ]);
            }

            $receipt->setFkEstatus($status);*/
            $receipt->setFecEstatus(new \DateTime('now'));

            $repositoryValue = $this->getDoctrine()->getRepository(TipoValor::class);
            $typeValue = $repositoryValue->findOneBy([
                'codValor' => $requestBody['type_value']
            ]);

            if (!$typeValue) {
                return $this->json([
                    'error' => "TYPE_VALUE_NOT_FOUND_ERROR"
                ]);
            }

            $receipt->setFkTipoValor($typeValue);

            $repositoryMoney = $this->getDoctrine()->getRepository(TipoMoneda::class);
            $typeMoney = $repositoryMoney->findOneBy([
                'codMoneda' => $requestBody['type_money']
            ]);

            if (!$typeMoney) {
                return $this->json([
                    'error' => "TYPE_VALUE_NOT_FOUND_ERROR"
                ]);
            }

            $receipt->setFkTipoMOneda($typeMoney);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($receipt);
            $entityManager->flush();

            //set line receipt

            $repositoryReceipt = $this->getDoctrine()->getRepository(ComprobanteServicio::class);
            $newReceipt = $repositoryReceipt->findOneBy([
                'idComprobanteServicio' => $receipt->getId()
            ]);

            $csPointLr = new CsPuntoLr();
            $csPointLr->setUsuarioCreacion($requestBody['username']);
            $csPointLr->setFecCreacion(new \DateTime('now'));
            $csPointLr->setFecModificacion(null);
            

            $repositoryStatus = $this->getDoctrine()->getRepository(Estatus::class);
            $status = $repositoryStatus->findOneBy([
                'idEstatus' => 11
            ]);

            if (!$status) {
                return $this->json([
                    'error' => "STATUS_NOT_FOUND_ERROR"
                ]);
            }
            $csPointLr->setFkEstatus($status);
            $csPointLr->setFecEstatus(new \DateTime('now'));
            $csPointLr->setEstatusRegistro(1);
            $csPointLr->setFkComprobanteServicio($newReceipt);

            $repositoryOperation = $this->getDoctrine()->getRepository(TipoOperacion::class);
            $operation = $repositoryOperation->findOneBy([
                'idTipoOperacion' => 2
            ]);

            if (!$operation) {
                return $this->json([
                    'error' => "OPERATION_NOT_FOUND_ERROR"
                ]);
            }
            $csPointLr->setFkTipoOperacion($operation);
            $repositoryPointLr = $this->getDoctrine()->getRepository(PuntoLr::class);
            $point = $repositoryPointLr->findOneBy([
                'idPuntoLr' => $requestBody['id_punto_lr']
            ]);

            if (!$point) {
                return $this->json([
                    'error' => "PUNTO_LR_NOT_FOUND_ERROR"
                ]);
            }
            $csPointLr->setFkPuntoLr($point);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($csPointLr);
            $entityManager->flush();

            $tracking->setFkCsPuntoLr($csPointLr);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tracking);
            $entityManager->flush();

            return $this->json([
                'message' => "SUCCESS"
            ]);
            

        }else{
            //obtain point_lr
            $repositoryPointLr = $this->getDoctrine()->getRepository(PuntoLr::class);
            $pointSearch = $repositoryPointLr->findOneBy([
                'idPuntoLr' => $requestBody['id_punto_lr']
            ]);

            //delivery
            $repositoryReceiptPoint = $this->getDoctrine()->getRepository(CsPuntoLr::class);
            $receiptPoint = $repositoryReceiptPoint->findOneBy([
                'fkComprobanteServicio' => $receipt,
                'fkPuntolr' => $pointSearch
            ]);

            if (!$receiptPoint) {
               /* return $this->json([
                    'error' => "RECEIPT_NOT_FOUND_ERROR"
                ]);*/
                $csPointLr = new CsPuntoLr();
                $csPointLr->setUsuarioCreacion($requestBody['username']);
                $csPointLr->setFecCreacion(new \DateTime('now'));
                $csPointLr->setFecModificacion(null);
                $repositoryStatus = $this->getDoctrine()->getRepository(Estatus::class);
                $status = $repositoryStatus->findOneBy([
                    'idEstatus' => 11
                ]);
                $csPointLr->setFkEstatus($status);
                $csPointLr->setFecEstatus(new \DateTime('now'));
                $csPointLr->setEstatusRegistro(1);
                $csPointLr->setFkComprobanteServicio($receipt);

                $repositoryOperation = $this->getDoctrine()->getRepository(TipoOperacion::class);
                $operation = $repositoryOperation->findOneBy([
                    'idTipoOperacion' => 2
                ]);

                if (!$operation) {
                    return $this->json([
                        'error' => "OPERATION_NOT_FOUND_ERROR"
                    ]);
                }
                $csPointLr->setFkTipoOperacion($operation);
                $csPointLr->setFkPuntoLr($pointSearch);

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($csPointLr);
                $entityManager->flush();

                if ($requestBody['incident_name'] != null) {

                    $repositoryCause = $this->getDoctrine()->getRepository(CausaNoEjecucion::class);
                    $cause = $repositoryCause->findOneBy([
                        'descripcion' => $requestBody['incident_name']
                    ]);
        
                    if (!$cause) {
                        return $this->json([
                            'error' => "CAUSE_NOT_FOUND_ERROR"
                        ]);
                    }
                    $csPointLr->setFkCausaNoEjecucion($cause);
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($csPointLr);
                    $entityManager->flush();
                }
                
    
                $tracking->setFkCsPuntoLr($csPointLr);
                
            
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($tracking);
                $entityManager->flush();
    
            
                return $this->json([
                    'message' => 'SUCCESS'
                ]);

            }else{
                if ($requestBody['incident_name'] != null) {

                    $repositoryCause = $this->getDoctrine()->getRepository(CausaNoEjecucion::class);
                    $cause = $repositoryCause->findOneBy([
                        'descripcion' => $requestBody['incident_name']
                    ]);
        
                    if (!$cause) {
                        return $this->json([
                            'error' => "CAUSE_NOT_FOUND_ERROR"
                        ]);
                    }
                    $receiptPoint->setFkCausaNoEjecucion($cause);
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($receiptPoint);
                    $entityManager->flush();
                }
                
    
                $tracking->setFkCsPuntoLr($receiptPoint);
                
            
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($tracking);
                $entityManager->flush();
    
            
                return $this->json([
                    'message' => 'SUCCESS'
                ]);
            }

            
        }

        
    
    }

    public function insertPackingsAfterCheck() : Response {

        $request = Request::createFromGlobals();
    
        $decoded = $this->authService->validateRequest($request);
    
        if (gettype($decoded) == 'array' && isset($decoded['error'])) {
          return $this->json($decoded);
        }
    
        $requestBody = json_decode($request->getContent(), true);

        foreach ($requestBody['packaging'] as $key => $value) {

            $packing = new Envase();

            $packing->setCodEnvase($value['code']);
            $packing->setFecEscaneo(new \DateTime('now'));
            $packing->setUsuarioCreacion($requestBody['username']);
            $packing->setUsuarioModificacion($requestBody['username']);
            $packing->setRegistroManual($value['manual']);
            $packing->setEstatusRegistro(1);
            $packing->setFecCreacion(new \DateTime('now'));
            $packing->setFecModificacion(new \DateTime('now'));
            $packing->setEstatusRegistro(1);
            
        
            $repository = $this->getDoctrine()->getRepository(Estatus::class);
            $status = $repository->findOneBy([
                'idEstatus' => $value['status']
            ]);

            if (!$status) {
                return $this->json([
                    'error' => "STATUS_NOT_FOUND_ERROR"
                ]);
            }

            $packing->setFkEstatus($status);
            $packing->setFecEstatus(new \DateTime('now'));

            $repositoryReceipt = $this->getDoctrine()->getRepository(ComprobanteServicio::class);
            $receipt = $repositoryReceipt->findOneBy([
                'codCs' => $requestBody['code']
            ]);

            $packing->setFkComprobanteServicio($receipt);
            
        
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($packing);
            $entityManager->flush();

        }
    
    
        return $this->json([
          'message' => 'SUCCESS'
        ]);
    
    }

    public function insertTrackingPendingReceiptsApp() : Response {
        $request = Request::createFromGlobals();

        $decoded = $this->authService->validateRequest($request);
        if (gettype($decoded) == 'array' && isset($decoded['error'])) {
            return $this->json($decoded);
        }

        $requestBody = json_decode($request->getContent(), true);
        

        foreach ($requestBody['receipts'] as $key => $valueReceipts) {

            $tracking = new TrackingCs();
            $tracking->setUsuarioCreacion($valueReceipts['username']);
            $tracking->setUsuarioModificacion($valueReceipts['username']);
            $tracking->setFecCreacion(new \DateTime($valueReceipts['date']));
            $tracking->setFecModificacion(new \DateTime($valueReceipts['date']));
            $tracking->setEstatusRegistro(1);
            
        
            $repository = $this->getDoctrine()->getRepository(Estatus::class);
            $status = $repository->findOneBy([
                'idEstatus' => $valueReceipts['status']
            ]);

            if (!$status) {
                $tracking->setFkEstatus(null);
            }else{
                $tracking->setFkEstatus($status);
            }

            
            $tracking->setFecEstatus(new \DateTime($valueReceipts['date']));

            $repositoryReceipt = $this->getDoctrine()->getRepository(ComprobanteServicio::class);
            $receipt = $repositoryReceipt->findOneBy([
                'codCs' => $valueReceipts['code']
            ]);

            if (!$receipt) {
                //pickup
                $receipt = new ComprobanteServicio();
                $receipt->setCorrelativo(null);
                $receipt->setCodCliente($valueReceipts['cod_client']);
                $receipt->setCodCs($valueReceipts['code']);
                $receipt->setDiceContener($valueReceipts['total']);
                $receipt->setCodOrigen($valueReceipts['origin']);
                $receipt->setCodDestino($valueReceipts['destiny']);
                $receipt->setUsuarioCreacion($valueReceipts['username']);
                $receipt->setUsuarioModificacion($valueReceipts['username']);
                $receipt->setEstatusRegistro(1);
                $receipt->setFecCreacion(new \DateTime($valueReceipts['date']));
                $receipt->setFecModificacion(new \DateTime($valueReceipts['date']));
                $receipt->setCantEnvases($valueReceipts['total_packing']);
                $receipt->setFecEstatus(new \DateTime($valueReceipts['date']));

                $repositoryValue = $this->getDoctrine()->getRepository(TipoValor::class);
                $typeValue = $repositoryValue->findOneBy([
                    'codValor' => $valueReceipts['type_value']
                ]);

                if (!$typeValue) {
                    $receipt->setFkTipoValor(null);
                }else{
                    $receipt->setFkTipoValor($typeValue);
                }

                $repositoryMoney = $this->getDoctrine()->getRepository(TipoMoneda::class);
                $typeMoney = $repositoryMoney->findOneBy([
                    'codMoneda' => $valueReceipts['type_money']
                ]);

                if (!$typeMoney) {
                    $receipt->setFkTipoMOneda(null);
                }else{
                    $receipt->setFkTipoMOneda($typeMoney);
                }

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($receipt);
                $entityManager->flush();

                //set line receipt

                $repositoryReceipt = $this->getDoctrine()->getRepository(ComprobanteServicio::class);
                $newReceipt = $repositoryReceipt->findOneBy([
                    'idComprobanteServicio' => $receipt->getId()
                ]);

                $csPointLr = new CsPuntoLr();
                $csPointLr->setUsuarioCreacion($valueReceipts['username']);
                $csPointLr->setFecCreacion(new \DateTime($valueReceipts['date']));
                $csPointLr->setFecModificacion(null);
                

                $repositoryStatus = $this->getDoctrine()->getRepository(Estatus::class);
                $status = $repositoryStatus->findOneBy([
                    'idEstatus' => 11
                ]);

                if (!$status) {
                    return $this->json([
                        'error' => "STATUS_NOT_FOUND_ERROR"
                    ]);
                }
                $csPointLr->setFkEstatus($status);
                $csPointLr->setFecEstatus(new \DateTime($valueReceipts['date']));
                $csPointLr->setEstatusRegistro(1);
                $csPointLr->setFkComprobanteServicio($newReceipt);

                $repositoryOperation = $this->getDoctrine()->getRepository(TipoOperacion::class);
                $operation = $repositoryOperation->findOneBy([
                    'idTipoOperacion' => 2
                ]);

                if (!$operation) {
                    /*return $this->json([
                        'error' => "OPERATION_NOT_FOUND_ERROR"
                    ]);*/
                    $csPointLr->setFkTipoOperacion(null);
                }else{
                    $csPointLr->setFkTipoOperacion($operation);
                }
                $repositoryPointLr = $this->getDoctrine()->getRepository(PuntoLr::class);
                $point = $repositoryPointLr->findOneBy([
                    'idPuntoLr' => $valueReceipts['id_punto_lr']
                ]);

                if (!$point) {
                    return $this->json([
                        'error' => "PUNTO_LR_NOT_FOUND_ERROR"
                    ]);
                }
                $csPointLr->setFkPuntoLr($point);

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($csPointLr);
                $entityManager->flush();

                $tracking->setFkCsPuntoLr($csPointLr);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($tracking);
                $entityManager->flush();
                
            }else{
                //delivery
                $repositoryReceiptPoint = $this->getDoctrine()->getRepository(CsPuntoLr::class);
                $receiptPoint = $repositoryReceiptPoint->findOneBy([
                    'fkComprobanteServicio' => $receipt
                ]);

                if (!$receiptPoint) {
                    return $this->json([
                        'error' => "RECEIPT_NOT_FOUND_ERROR"
                    ]);
                }

                if ($valueReceipts['incident_name'] != null) {

                    $repositoryCause = $this->getDoctrine()->getRepository(CausaNoEjecucion::class);
                    $cause = $repositoryCause->findOneBy([
                        'descripcion' => $valueReceipts['incident_name']
                    ]);
        
                    if (!$cause) {
                        $receiptPoint->setFkCausaNoEjecucion(null);
                    }else{
                        $receiptPoint->setFkCausaNoEjecucion($cause);
                    }
                    
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($receiptPoint);
                    $entityManager->flush();
                }
                

                $tracking->setFkCsPuntoLr($receiptPoint);
                
            
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($tracking);
                $entityManager->flush();

            }
        }

        $receiptsIndex = [];
        foreach ($requestBody['receipts'] as $key => $value){
            array_push($receiptsIndex, $value['index']);
        }
        
        return $this->json([
            'message'=> "SUCCESS",
            'receipts_id' => $receiptsIndex
        ]);
        
    }

    public function insertPackingsPendingApp() : Response {

        $request = Request::createFromGlobals();
    
        $decoded = $this->authService->validateRequest($request);
    
        if (gettype($decoded) == 'array' && isset($decoded['error'])) {
          return $this->json($decoded);
        }
    
        $requestBody = json_decode($request->getContent(), true);
        $repositoryStatus = $this->getDoctrine()->getRepository(Estatus::class);
        $status = $repositoryStatus->findOneBy([
            'idEstatus' => 16
        ]);

        foreach ($requestBody['receipts'] as $key => $valueReceipts) {

            foreach ($valueReceipts['packaging'] as $key => $value) {

                $repositoryReceipt = $this->getDoctrine()->getRepository(ComprobanteServicio::class);
                $receipt = $repositoryReceipt->findOneBy([
                    'codCs' => $valueReceipts['code']
                ]);

                $packing = new Envase();
                if ($receipt) {
                    $packing->setFkComprobanteServicio($receipt);
                }else{
                    $packing->setFkComprobanteServicio(null);
                }
        
                $packing->setCodEnvase($value['code']);
                $packing->setFecEscaneo(new \DateTime($valueReceipts['date']));
                $packing->setUsuarioCreacion($valueReceipts['username']);
                $packing->setUsuarioModificacion($valueReceipts['username']);
                $packing->setRegistroManual($value['manual']);
                $packing->setEstatusRegistro(1);
                $packing->setFecEstatus(new \DateTime($valueReceipts['date']));
                $packing->setFecCreacion(new \DateTime($valueReceipts['date']));
                $packing->setFecModificacion(new \DateTime($valueReceipts['date']));
                
                $packing->setFkEstatus($status);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($packing);
                $entityManager->flush();
                    
            }

        }
    
    
        $packingIndex = [];
        foreach ($requestBody['receipts'] as $key => $value){
            array_push($packingIndex, $value['index']);
        }
        
        return $this->json([
            'message'=> "SUCCESS",
            'packings_id' => $packingIndex
        ]);
    
    }
}
