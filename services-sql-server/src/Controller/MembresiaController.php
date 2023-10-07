<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Service\SerializerService;
use App\Service\AuthService;

use App\Entity\Membresia;

class MembresiaController extends AbstractController {
    public function __construct(SerializerService $serializerService, AuthService $authService) {
        $this->serializerService = $serializerService;
        $this->authService = $authService;
    }

    public function getMembresias(): Response{

        $request = Request::createFromGlobals();
        
        /*$decoded = $this->authService->validateRequest($request);
        if (gettype($decoded) == 'array' && isset($decoded['error'])) {
            return $this->json($decoded);
        }*/

        $connection = $this->getDoctrine()->getConnection();
        $sql = 'SELECT * FROM membresia where ESTATUS_REGISTRO = 1';
        $prepare = $connection->query($sql);
        $resultSet = $prepare->fetchAll();
    
        if (!$resultSet) {
        return $this->json([
            'error' => "NOT_FOUND"
        ]);
        }
    
        $serializer = $this->serializerService->getSerializer();
        $data = $serializer->serialize($resultSet, 'json');
    
        return new Response($data);
    }

    public function getMembresiasUser($user): Response{

        $request = Request::createFromGlobals();
        
        $decoded = $this->authService->validateRequest($request);
        if (gettype($decoded) == 'array' && isset($decoded['error'])) {
            return $this->json($decoded);
        }

        $sql = "SELECT membresia.FK_ALCANCE
        ,membresia.ENTIDAD
        ,membresia.FK_FUNCION 
        ,usuario.NB_USUARIO
        ,usuario.CLAVE
        ,funcion.DESCRIPCION as FUNCION
        FROM membresia as membresia
        JOIN usuario as usuario
        ON usuario.ID = membresia.FK_USUARIO
        JOIN funcion as funcion
        ON funcion.ID_FUNCION = membresia.FK_FUNCION
        WHERE membresia.ESTATUS_REGISTRO = 1 AND usuario.NB_USUARIO = '".$user."';";

        $connection = $this->getDoctrine()->getConnection();
        $prepare = $connection->query($sql);
        $resultSet = $prepare->fetchAll();
    
        if (!$resultSet) {
        return $this->json([
            'error' => "NOT_FOUND"
        ]);
        }
    
        $serializer = $this->serializerService->getSerializer();
        $data = $serializer->serialize($resultSet, 'json');
    
        return new Response($data);
    }

    public function colocarMembresias(): Response
    {
        $request = Request::createFromGlobals();
        $requestBody = json_decode($request->getContent(), true);
        $sql = $requestBody['MEMBRESIAS'];
        $conn = $this->getDoctrine()->getManager()->getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $this->json([
        'message' => 'INSERT MEMBRESIAS SUCCESS',$sql
        ]);
    }

}
