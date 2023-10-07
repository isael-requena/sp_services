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
use \stdClass;

use App\Entity\Tripulante;

class TripulanteController extends AbstractController {

    private $serializerService;

    public function __construct(SerializerService $serializerService, AuthService $authService) {
        $this->serializerService = $serializerService;
        $this->authService = $authService;
    }
    
    public function getByTourList($id): Response{

        $request = Request::createFromGlobals();
    
        $decoded = $this->authService->validateRequest($request);
        if (gettype($decoded) == 'array' && isset($decoded['error'])) {
            return $this->json($decoded);
        }
    
        $repository = $this->getDoctrine()->getRepository(Tripulante::class);
        $crew = $repository->findBy([
            'fkListaRecorrido' => $id,
            'estatusRegistro' => 1
        ],[
            'fecCreacion' => 'DESC'
        ]);
        
    
        if (!$crew) {
          return $this->json([
            'message' => "CREW_NOT_FOUND"
          ]);
        }

        $crewFilter = [];
        
        foreach ($crew as $key => $value) {
            if ($value->getFkPersona() != null) {
                $crewMember = new \stdClass();
                $crewMember->rol = $value->getFkRol();
                $crewMember->numEmpleado = $value->getFkPersona()->getNumEmpleado();
                $crewMember->primerNombre = $value->getFkPersona()->getPrimerNombre();
                $crewMember->primerApellido = $value->getFkPersona()->getPrimerApellido();
                array_push($crewFilter, $crewMember);
            }
        }
        
        return $this->json([
            'tripulacion' => $crewFilter
        ]);
    }

}
