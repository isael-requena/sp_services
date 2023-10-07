<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Service\SerializerService;
use App\Service\AuthService;
use App\Entity\Parametros;

class ParametroController extends AbstractController{
    public function __construct(SerializerService $serializerService, AuthService $authService) {
        $this->serializerService = $serializerService;
        $this->authService = $authService;
    }

    public function getParametros(): Response{

        $request = Request::createFromGlobals();
        
        $decoded = $this->authService->validateRequest($request);
        if (gettype($decoded) == 'array' && isset($decoded['error'])) {
            return $this->json($decoded);
        }

        $connection = $this->getDoctrine()->getConnection();
        $sql = 'SELECT * FROM parametros';
        $prepare = $connection->query($sql);
        $resultSet = $prepare->fetch();
    
        if (!$resultSet) {
        return $this->json([
            'error' => "NOT_FOUND"
        ]);
        }
    
        $serializer = $this->serializerService->getSerializer();
        $data = $serializer->serialize($resultSet, 'json');
    
        return new Response($data);
    }
    
    public function getAll(): Response{

        $request = Request::createFromGlobals();
    
        $decoded = $this->authService->validateRequest($request);
        if (gettype($decoded) == 'array' && isset($decoded['error'])) {
            return $this->json($decoded);
        }
    
        $repository = $this->getDoctrine()->getRepository(Parametros::class);
        $users = $repository->findAll();
        
    
        if (!$users) {
          return $this->json([
            'error' => "USERS_NOT_FOUND"
          ]);
        }
    
        $serializer = $this->serializerService->getSerializer();
        $data = $serializer->serialize($users, 'json');
    
        return new Response($data);
    }

    public function update(): Response{
        $request = Request::createFromGlobals();
        $requestBody = json_decode($request->getContent(), true);
        $sql = " UPDATE `parametros` SET `EXCESO_LIMITE`=?,
        `EXCESO_LIMITE_ALERTA`=?,
        `REFRESCAMIENTO`=?,
        `REFRESCAMIENTO_MOVIL`=?,
        `TIEMPO_SIN_CONEXION`=?,
        `TIEMPO_EJECUCION_ETL`=?,
        `FEC_MODIFICACION`= CURRENT_TIMESTAMP() WHERE ID_PARAMETRO = 1; ";
        $conn = $this->getDoctrine()->getManager()->getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $requestBody['EXCESO_LIMITE']);
        $stmt->bindValue(2, $requestBody['EXCESO_LIMITE_ALERTA']);
        $stmt->bindValue(3, $requestBody['REFRESCAMIENTO']);
        $stmt->bindValue(4, $requestBody['REFRESCAMIENTO_MOVIL']);
        $stmt->bindValue(5, $requestBody['TIEMPO_SIN_CONEXION']);
        $stmt->bindValue(6, $requestBody['TIEMPO_EJECUCION_ETL']);
        $stmt->execute();
        return $this->json([
            'message' => 'UPDATE PARAMETROS SUCCESS',$sql
        ]);
    }
}
