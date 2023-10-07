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
use App\Entity\Punto;

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

        foreach ($tracking as $key => $value) {
            $repository = $this->getDoctrine()->getRepository(Punto::class);
            $originPoint = $repository->findOneBy([
                'codPunto' => $value->getPuntoOrigen()
            ]);
            if ($originPoint) {
                $direction = "";
                switch ($originPoint->getCodPunto()) {
                    case !null:
                        $direction.= rtrim($originPoint->getCodPunto());
                        break;
                }
                switch ($originPoint->getNombrePunto()) {
                    case !null:
                        $direction.=" ".rtrim($originPoint->getNombrePunto());
                        break;
                }
                switch ($originPoint->getVia()) {
                    case !null:
                        $direction.=" ".rtrim($originPoint->getVia());
                        break;
                }
                switch ($originPoint->getCentroPob()) {
                    case !null:
                        $direction.=" ".rtrim($originPoint->getCentroPob());
                        break;
                }
                switch ($originPoint->getEdificacion()) {
                    case !null:
                        $direction.=" ".rtrim($originPoint->getEdificacion());
                        break;
                }
                $value->setDescripcionPuntoOrigen($direction);
            }
            $destinyPoint = $repository->findOneBy([
                'codPunto' => $value->getPuntoDestino()
            ]);
            if ($destinyPoint) {
                $directionDestiny = "";
                switch ($destinyPoint->getCodPunto()) {
                    case !null:
                        $directionDestiny.= rtrim($destinyPoint->getCodPunto());
                        break;
                }
                switch ($destinyPoint->getNombrePunto()) {
                    case !null:
                        $directionDestiny.=" ".rtrim($destinyPoint->getNombrePunto());
                        break;
                }
                switch ($destinyPoint->getVia()) {
                    case !null:
                        $directionDestiny.=" ".rtrim($destinyPoint->getVia());
                        break;
                }
                switch ($destinyPoint->getCentroPob()) {
                    case !null:
                        $directionDestiny.=" ".rtrim($destinyPoint->getCentroPob());
                        break;
                }
                switch ($destinyPoint->getEdificacion()) {
                    case !null:
                        $directionDestiny.=" ".rtrim($destinyPoint->getEdificacion());
                        break;
                }
                $value->setDescripcionPuntoDestino($directionDestiny);
            }
            
        }

        $serializer = $this->serializerService->getSerializer();
        $data = $serializer->serialize($tracking, 'json');

        return new Response($data);
    
    }
}
