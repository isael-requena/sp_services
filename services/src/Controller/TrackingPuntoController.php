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
use App\Entity\TrackingPunto;
use App\Entity\TrackingCs;
use App\Entity\Estatus;
use App\Entity\PuntoLr;
use App\Entity\CsPuntoLr;
use App\Entity\CausaNoEjecucion;

class TrackingPuntoController extends AbstractController{

    private $serializerService;

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
    
        $tracking = new TrackingPunto();
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

        $repositoryPointLr = $this->getDoctrine()->getRepository(PuntoLr::class);
        $point = $repositoryPointLr->findOneBy([
            'idPuntoLr' => $requestBody['id']
        ]);

        if (!$point) {
            return $this->json([
                'error' => "POINT_NOT_FOUND_ERROR"
            ]);
        }

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
            $point->setFkCausaNoEjecucion($cause);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($point);
            $entityManager->flush();

            $repository = $this->getDoctrine()->getRepository(CsPuntoLr::class);
            $receipts = $repository->findBy([
                'fkPuntolr' => $point
            ]);
            
        
            if ($receipts) {

                foreach ($receipts as $key => $value) {

                    if ($value->getFkTipoOperacion() == null) {
                        $trackingReceipt = new TrackingCs();
                        $trackingReceipt->setUsuarioCreacion($requestBody['username']);
                        $trackingReceipt->setUsuarioModificacion($requestBody['username']);
                        $trackingReceipt->setFecCreacion(new \DateTime('now'));
                        $trackingReceipt->setFecModificacion(new \DateTime('now'));
                        $trackingReceipt->setEstatusRegistro(1);
                        $repositoryStatus = $this->getDoctrine()->getRepository(Estatus::class);
                        $statusReceipt = $repositoryStatus->findOneBy([
                            'idEstatus' => 13
                        ]);
                        $trackingReceipt->setFkEstatus($statusReceipt);
                        $trackingReceipt->setFecEstatus(new \DateTime('now'));
                        $trackingReceipt->setFkCsPuntoLr($value);
                        $entityManager = $this->getDoctrine()->getManager();
                        $entityManager->persist($trackingReceipt);
                        $entityManager->flush();
                    }else{
                        if ($value->getFkTipoOperacion()->getIdTipoOperacion() == 1) {
                            $trackingReceipt = new TrackingCs();
                            $trackingReceipt->setUsuarioCreacion($requestBody['username']);
                            $trackingReceipt->setUsuarioModificacion($requestBody['username']);
                            $trackingReceipt->setFecCreacion(new \DateTime('now'));
                            $trackingReceipt->setFecModificacion(new \DateTime('now'));
                            $trackingReceipt->setEstatusRegistro(1);
                            $repositoryStatus = $this->getDoctrine()->getRepository(Estatus::class);
                            $statusReceipt = $repositoryStatus->findOneBy([
                                'idEstatus' => 13
                            ]);
                            $trackingReceipt->setFkEstatus($statusReceipt);
                            $trackingReceipt->setFecEstatus(new \DateTime('now'));
                            $trackingReceipt->setFkCsPuntoLr($value);
                            $entityManager = $this->getDoctrine()->getManager();
                            $entityManager->persist($trackingReceipt);
                            $entityManager->flush();
                        }else{
                            $trackingReceipt = new TrackingCs();
                            $trackingReceipt->setUsuarioCreacion($requestBody['username']);
                            $trackingReceipt->setUsuarioModificacion($requestBody['username']);
                            $trackingReceipt->setFecCreacion(new \DateTime('now'));
                            $trackingReceipt->setFecModificacion(new \DateTime('now'));
                            $trackingReceipt->setEstatusRegistro(1);
                            $repositoryStatus = $this->getDoctrine()->getRepository(Estatus::class);
                            $statusReceipt = $repositoryStatus->findOneBy([
                                'idEstatus' => 15
                            ]);
                            $trackingReceipt->setFkEstatus($statusReceipt);
                            $trackingReceipt->setFecEstatus(new \DateTime('now'));
                            $trackingReceipt->setFkCsPuntoLr($value);
                            $entityManager = $this->getDoctrine()->getManager();
                            $entityManager->persist($trackingReceipt);
                            $entityManager->flush();
                        }
                    }
                }
            }

            
            
        }
        
        if ($requestBody['status'] == 4) {
            $point->setFkCausaNoEjecucion(null);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($point);
            $entityManager->flush();

            $repository = $this->getDoctrine()->getRepository(CsPuntoLr::class);
            $receipts = $repository->findBy([
                'fkPuntolr' => $point
            ]);
            
        
            /*if ($receipts) {

                foreach ($receipts as $key => $value) {

                    if ($value->getFkTipoOperacion() == null) {
                        $trackingReceipt = new TrackingCs();
                        $trackingReceipt->setUsuarioCreacion($requestBody['username']);
                        $trackingReceipt->setUsuarioModificacion($requestBody['username']);
                        $trackingReceipt->setFecCreacion(new \DateTime('now'));
                        $trackingReceipt->setFecModificacion(new \DateTime('now'));
                        $trackingReceipt->setEstatusRegistro(1);
                        $repositoryStatus = $this->getDoctrine()->getRepository(Estatus::class);
                        $status = $repositoryStatus->findOneBy([
                            'idEstatus' => 10
                        ]);
                        $trackingReceipt->setFkEstatus($status);
                        $trackingReceipt->setFecEstatus(new \DateTime('now'));
                        $trackingReceipt->setFkCsPuntoLr($value);
                        $entityManager = $this->getDoctrine()->getManager();
                        $entityManager->persist($trackingReceipt);
                        $entityManager->flush();
                    }else{
                        if ($value->getFkTipoOperacion()->getIdTipoOperacion() == 1) {
                            $trackingReceipt = new TrackingCs();
                            $trackingReceipt->setUsuarioCreacion($requestBody['username']);
                            $trackingReceipt->setUsuarioModificacion($requestBody['username']);
                            $trackingReceipt->setFecCreacion(new \DateTime('now'));
                            $trackingReceipt->setFecModificacion(new \DateTime('now'));
                            $trackingReceipt->setEstatusRegistro(1);
                            $repositoryStatus = $this->getDoctrine()->getRepository(Estatus::class);
                            $status = $repositoryStatus->findOneBy([
                                'idEstatus' => 10
                            ]);
                            $trackingReceipt->setFkEstatus($status);
                            $trackingReceipt->setFecEstatus(new \DateTime('now'));
                            $trackingReceipt->setFkCsPuntoLr($value);
                            $entityManager = $this->getDoctrine()->getManager();
                            $entityManager->persist($trackingReceipt);
                            $entityManager->flush();
                        }else{
                            $trackingReceipt = new TrackingCs();
                            $trackingReceipt->setUsuarioCreacion($requestBody['username']);
                            $trackingReceipt->setUsuarioModificacion($requestBody['username']);
                            $trackingReceipt->setFecCreacion(new \DateTime('now'));
                            $trackingReceipt->setFecModificacion(new \DateTime('now'));
                            $trackingReceipt->setEstatusRegistro(1);
                            $repositoryStatus = $this->getDoctrine()->getRepository(Estatus::class);
                            $status = $repositoryStatus->findOneBy([
                                'idEstatus' => 10
                            ]);
                            $trackingReceipt->setFkEstatus($status);
                            $trackingReceipt->setFecEstatus(new \DateTime('now'));
                            $trackingReceipt->setFkCsPuntoLr($value);
                            $entityManager = $this->getDoctrine()->getManager();
                            $entityManager->persist($trackingReceipt);
                            $entityManager->flush();
                        }
                    }
                }
            }*/
        }

        $tracking->setFkPuntolr($point);
        
    
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($tracking);
        $entityManager->flush();
    
        return $this->json([
          'message' => 'SUCCESS'
        ]);
    
    }

    public function insertMultipleTrackingEvents(){

        $request = Request::createFromGlobals();

        $decoded = $this->authService->validateRequest($request);
        if (gettype($decoded) == 'array' && isset($decoded['error'])) {
            return $this->json($decoded);
        }

        $requestBody = json_decode($request->getContent(), true);

        $repositoryStatus = $this->getDoctrine()->getRepository(Estatus::class);
        $status = $repositoryStatus->findOneBy([
            'idEstatus' => $requestBody['status']
        ]);

        foreach ($requestBody['points'] as $key => $value) {

            $tracking = new TrackingPunto();
            $tracking->setUsuarioCreacion($requestBody['username']);
            $tracking->setUsuarioModificacion($requestBody['username']);
            $tracking->setFecCreacion(new \DateTime('now'));
            $tracking->setFecModificacion(new \DateTime('now'));
            $tracking->setEstatusRegistro(1);

            $tracking->setFkEstatus($status);
            $tracking->setFecEstatus(new \DateTime('now'));

            $repositoryPointLr = $this->getDoctrine()->getRepository(PuntoLr::class);
            $point = $repositoryPointLr->findOneBy([
                'idPuntoLr' => $value['id']
            ]);

            if (!$point) {
                $tracking->setFkPuntolr(null);
            }else{
                $tracking->setFkPuntolr($point);
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

                    $point->setFkCausaNoEjecucion($cause);
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($point);
                    $entityManager->flush();

                    //insert tracking on receipts
                    $repository = $this->getDoctrine()->getRepository(CsPuntoLr::class);
                    $receipts = $repository->findBy([
                        'fkPuntolr' => $point
                    ]);
                    
                
                    if ($receipts) {

                        foreach ($receipts as $key => $value) {

                            if ($value->getFkTipoOperacion() == null) {
                                $trackingReceipt = new TrackingCs();
                                $trackingReceipt->setUsuarioCreacion($requestBody['username']);
                                $trackingReceipt->setUsuarioModificacion($requestBody['username']);
                                $trackingReceipt->setFecCreacion(new \DateTime('now'));
                                $trackingReceipt->setFecModificacion(new \DateTime('now'));
                                $trackingReceipt->setEstatusRegistro(1);
                                $repositoryStatus = $this->getDoctrine()->getRepository(Estatus::class);
                                $statusReceipts = $repositoryStatus->findOneBy([
                                    'idEstatus' => 13
                                ]);
                                $trackingReceipt->setFkEstatus($statusReceipts);
                                $trackingReceipt->setFecEstatus(new \DateTime('now'));
                                $trackingReceipt->setFkCsPuntoLr($value);
                                $entityManager = $this->getDoctrine()->getManager();
                                $entityManager->persist($trackingReceipt);
                                $entityManager->flush();
                            }else{
                                if ($value->getFkTipoOperacion()->getIdTipoOperacion() == 1) {
                                    $trackingReceipt = new TrackingCs();
                                    $trackingReceipt->setUsuarioCreacion($requestBody['username']);
                                    $trackingReceipt->setUsuarioModificacion($requestBody['username']);
                                    $trackingReceipt->setFecCreacion(new \DateTime('now'));
                                    $trackingReceipt->setFecModificacion(new \DateTime('now'));
                                    $trackingReceipt->setEstatusRegistro(1);
                                    $repositoryStatus = $this->getDoctrine()->getRepository(Estatus::class);
                                    $statusReceipts = $repositoryStatus->findOneBy([
                                        'idEstatus' => 13
                                    ]);
                                    $trackingReceipt->setFkEstatus($statusReceipts);
                                    $trackingReceipt->setFecEstatus(new \DateTime('now'));
                                    $trackingReceipt->setFkCsPuntoLr($value);
                                    $entityManager = $this->getDoctrine()->getManager();
                                    $entityManager->persist($trackingReceipt);
                                    $entityManager->flush();
                                }else{
                                    $trackingReceipt = new TrackingCs();
                                    $trackingReceipt->setUsuarioCreacion($requestBody['username']);
                                    $trackingReceipt->setUsuarioModificacion($requestBody['username']);
                                    $trackingReceipt->setFecCreacion(new \DateTime('now'));
                                    $trackingReceipt->setFecModificacion(new \DateTime('now'));
                                    $trackingReceipt->setEstatusRegistro(1);
                                    $repositoryStatus = $this->getDoctrine()->getRepository(Estatus::class);
                                    $statusReceipts = $repositoryStatus->findOneBy([
                                        'idEstatus' => 15
                                    ]);
                                    $trackingReceipt->setFkEstatus($statusReceipts);
                                    $trackingReceipt->setFecEstatus(new \DateTime('now'));
                                    $trackingReceipt->setFkCsPuntoLr($value);
                                    $entityManager = $this->getDoctrine()->getManager();
                                    $entityManager->persist($trackingReceipt);
                                    $entityManager->flush();
                                }
                            }
                        }
                    }
                }
            }     
        
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tracking);
            $entityManager->flush();
            
        }

        $message = 'SUCCESS';
        
        return $this->json([
            'message' => $message
        ]);

    }

    public function insertTrackingPendingApp() : Response {
        $request = Request::createFromGlobals();

        $decoded = $this->authService->validateRequest($request);
        if (gettype($decoded) == 'array' && isset($decoded['error'])) {
            return $this->json($decoded);
        }

        $requestBody = json_decode($request->getContent(), true);

        foreach ($requestBody['points'] as $key => $value) {

            $tracking = new TrackingPunto();
            $tracking->setUsuarioCreacion($value['username']);
            $tracking->setUsuarioModificacion($value['username']);
            $tracking->setEstatusRegistro(1);
            $tracking->setFecCreacion(new \DateTime($value['date']));
            $tracking->setFecModificacion(new \DateTime($value['date']));
            $repositoryStatus = $this->getDoctrine()->getRepository(Estatus::class);
            $status = $repositoryStatus->findOneBy([
                'idEstatus' => $value['status']
            ]);

            $tracking->setFkEstatus($status);
            $tracking->setFecEstatus(new \DateTime($value['date']));

            $repositoryPointLr = $this->getDoctrine()->getRepository(PuntoLr::class);
            $point = $repositoryPointLr->findOneBy([
                'idPuntoLr' => $value['id']
            ]);

            if (!$point) {
                $tracking->setFkPuntolr(null);
            }else{
                $tracking->setFkPuntolr($point);
                if ($value['incident_name'] != null) {

                    $repositoryCause = $this->getDoctrine()->getRepository(CausaNoEjecucion::class);
                    $cause = $repositoryCause->findOneBy([
                        'descripcion' => $value['incident_name']
                    ]);
    
                    if (!$cause) {
                        return $this->json([
                            'error' => "CAUSE_NOT_FOUND_ERROR"
                        ]);
                    }

                    $point->setFkCausaNoEjecucion($cause);
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($point);
                    $entityManager->flush();

                    //insert tracking on receipts
                    $repository = $this->getDoctrine()->getRepository(CsPuntoLr::class);
                    $receipts = $repository->findBy([
                        'fkPuntolr' => $point
                    ]);
                    
                
                    if ($receipts) {

                        foreach ($receipts as $key => $valueReceipts) {

                            if ($valueReceipts->getFkTipoOperacion() == null) {
                                $trackingReceipt = new TrackingCs();
                                $trackingReceipt->setUsuarioCreacion($value['username']);
                                $trackingReceipt->setUsuarioModificacion($value['username']);
                                $trackingReceipt->setFecCreacion(new \DateTime($value['date']));
                                $trackingReceipt->setFecModificacion(new \DateTime($value['date']));
                                $trackingReceipt->setEstatusRegistro(1);
                                $repositoryStatus = $this->getDoctrine()->getRepository(Estatus::class);
                                $statusReceipts = $repositoryStatus->findOneBy([
                                    'idEstatus' => 13
                                ]);
                                $trackingReceipt->setFkEstatus($statusReceipts);
                                $trackingReceipt->setFecEstatus(new \DateTime($value['date']));
                                $trackingReceipt->setFkCsPuntoLr($valueReceipts);
                                $entityManager = $this->getDoctrine()->getManager();
                                $entityManager->persist($trackingReceipt);
                                $entityManager->flush();
                            }else{
                                if ($valueReceipts->getFkTipoOperacion()->getIdTipoOperacion() == 1) {
                                    $trackingReceipt = new TrackingCs();
                                    $trackingReceipt->setUsuarioCreacion($value['username']);
                                    $trackingReceipt->setUsuarioModificacion($value['username']);
                                    $trackingReceipt->setFecCreacion(new \DateTime($value['date']));
                                    $trackingReceipt->setFecModificacion(new \DateTime($value['date']));
                                    $trackingReceipt->setEstatusRegistro(1);
                                    $repositoryStatus = $this->getDoctrine()->getRepository(Estatus::class);
                                    $statusReceipts = $repositoryStatus->findOneBy([
                                        'idEstatus' => 13
                                    ]);
                                    $trackingReceipt->setFkEstatus($statusReceipts);
                                    $trackingReceipt->setFecEstatus(new \DateTime($value['date']));
                                    $trackingReceipt->setFkCsPuntoLr($valueReceipts);
                                    $entityManager = $this->getDoctrine()->getManager();
                                    $entityManager->persist($trackingReceipt);
                                    $entityManager->flush();
                                }else{
                                    $trackingReceipt = new TrackingCs();
                                    $trackingReceipt->setUsuarioCreacion($value['username']);
                                    $trackingReceipt->setUsuarioModificacion($value['username']);
                                    $trackingReceipt->setFecCreacion(new \DateTime($value['date']));
                                    $trackingReceipt->setFecModificacion(new \DateTime($value['date']));
                                    $trackingReceipt->setEstatusRegistro(1);
                                    $repositoryStatus = $this->getDoctrine()->getRepository(Estatus::class);
                                    $statusReceipts = $repositoryStatus->findOneBy([
                                        'idEstatus' => 15
                                    ]);
                                    $trackingReceipt->setFkEstatus($statusReceipts);
                                    $trackingReceipt->setFecEstatus(new \DateTime($value['date']));
                                    $trackingReceipt->setFkCsPuntoLr($valueReceipts);
                                    $entityManager = $this->getDoctrine()->getManager();
                                    $entityManager->persist($trackingReceipt);
                                    $entityManager->flush();
                                }
                            }
                        }
                    }
                }
            }     
        
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tracking);
            $entityManager->flush();
            
        }
        $pointsId = [];
        foreach ($requestBody['points'] as $key => $value){
            array_push($pointsId, $value['index']);
        }
        
        return $this->json([
            'message'=> "SUCCESS",
            'points_id' => $pointsId
        ]);
    }
    
}
