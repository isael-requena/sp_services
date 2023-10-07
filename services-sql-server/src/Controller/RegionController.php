<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Service\SerializerService;
use App\Service\AuthService;

class RegionController extends AbstractController{
    public function __construct(SerializerService $serializerService, AuthService $authService) {
        $this->serializerService = $serializerService;
        $this->authService = $authService;
    }

    public function getRegiones(): Response{

        $request = Request::createFromGlobals();
        
        $decoded = $this->authService->validateRequest($request);
        if (gettype($decoded) == 'array' && isset($decoded['error'])) {
            return $this->json($decoded);
        }

        $connection = $this->getDoctrine()->getConnection();
        $sql = 'SELECT *,
        ISNULL(o.NUMERO_OFICINAS, 0) as NUMERO_OFICINAS
        FROM region as r 
        LEFT JOIN (SELECT COUNT(ID_OFICINA) as NUMERO_OFICINAS, FK_REGION FROM oficina GROUP BY FK_REGION) AS o
        ON r.ID_REGION = o.FK_REGION
        WHERE r.ESTATUS_REGISTRO != 2 
        ORDER BY NB_REGION;';
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

    public function insert(): Response{
        $request = Request::createFromGlobals();
        $requestBody = json_decode($request->getContent(), true);
        $sql = "INSERT INTO region(NB_REGION, USUARIO_CREACION, USUARIO_MODIFICACION, FEC_CREACION, FEC_MODIFICACION, ESTATUS_REGISTRO) 
        VALUES 
        (?, ?, ?, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, 1); ";
        $sql .= " UPDATE oficina SET FK_REGION= SCOPE_IDENTITY() WHERE ID_OFICINA IN (";
        for ($i=0; $i < count($requestBody['OFICINAS']); $i++) { 
            if ($i!=0) {
                $sql .= ", ";
            };
            $sql .= $requestBody['OFICINAS'][$i];
        };
        $sql .= ");";
        $conn = $this->getDoctrine()->getManager()->getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $requestBody['NB_REGION']);
        $stmt->bindValue(2, $requestBody['USUARIO_CREACION']);
        $stmt->bindValue(3, $requestBody['USUARIO_MODIFICACION']);
        $stmt->execute();
        return $this->json([
            'message' => 'INSERT REGION SUCCESS'
        ]);
    }

    public function update(): Response{
        $request = Request::createFromGlobals();
        $requestBody = json_decode($request->getContent(), true);
        $sql = "UPDATE region SET NB_REGION=?,USUARIO_MODIFICACION=?,FEC_MODIFICACION= CURRENT_TIMESTAMP WHERE ID_REGION = ?; ";
        $sql .= " UPDATE oficina SET FK_REGION= ? WHERE ID_OFICINA IN (";
        for ($i=0; $i < count($requestBody['OFICINAS']); $i++) { 
            if ($i!=0) {
                $sql .= ", ";
            };
            $sql .= $requestBody['OFICINAS'][$i];
        };
        $sql .= "); ";

        $sql .= " UPDATE oficina SET FK_REGION= NULL WHERE ID_OFICINA NOT IN (";
        for ($i=0; $i < count($requestBody['OFICINAS']); $i++) { 
            if ($i!=0) {
                $sql .= ", ";
            };
            $sql .= $requestBody['OFICINAS'][$i];
        };
        $sql .= ") AND FK_REGION = ?;";
        $conn = $this->getDoctrine()->getManager()->getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $requestBody['NB_REGION']);
        $stmt->bindValue(2, $requestBody['USUARIO_MODIFICACION']);
        $stmt->bindValue(3, $requestBody['ID_REGION']);
        $stmt->bindValue(4, $requestBody['ID_REGION']);
        $stmt->bindValue(5, $requestBody['ID_REGION']);
        $stmt->execute();
        return $this->json([
            'message' => 'UPDATE REGION SUCCESS', $sql
        ]);
    }

    public function eliminar(): Response{
        $request = Request::createFromGlobals();
        $requestBody = json_decode($request->getContent(), true);
        $sql = "UPDATE region SET ESTATUS_REGISTRO= 2,USUARIO_MODIFICACION=?,FEC_MODIFICACION= CURRENT_TIMESTAMP WHERE ID_REGION = ?; ";
        $sql .= " UPDATE oficina SET FK_REGION= NULL WHERE FK_REGION = ?;";
        $conn = $this->getDoctrine()->getManager()->getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $requestBody['USUARIO_MODIFICACION']);
        $stmt->bindValue(2, $requestBody['ID_REGION']);
        $stmt->bindValue(3, $requestBody['ID_REGION']);
        $stmt->execute();
        return $this->json([
            'message' => 'ELIMINAR REGION SUCCESS'
        ]);
    }
}
