<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Service\SerializerService;
use App\Service\AuthService;
use App\Entity\ListaRecorrido;
use App\Entity\Estatus;

class ListaRecorridoController extends AbstractController {
    public function __construct(SerializerService $serializerService, AuthService $authService) {
        $this->serializerService = $serializerService;
        $this->authService = $authService;
    }

    public function updateTourList($id): Response{

        $request = Request::createFromGlobals();
        
        $decoded = $this->authService->validateRequest($request);
        if (gettype($decoded) == 'array' && isset($decoded['error'])) {
            return $this->json($decoded);
        }
        
        $requestBody = json_decode($request->getContent(), true);

        $repositoryTourList = $this->getDoctrine()->getRepository(ListaRecorrido::class);
        $tourList = $repositoryTourList->findOneBy([
            'idListaRecorrido' => $id
        ]);

        if (!$tourList) {
            return $this->json([
                'error' => "TOUR_LIST_NOT_FOUND_ERROR"
            ]);
        }
        if (!isset($requestBody['exit'])) {
            //salida
            $repositoryStatus = $this->getDoctrine()->getRepository(Estatus::class);
            $status = $repositoryStatus->findOneBy([
                'idEstatus' => 21
            ]);
            $tourList->setFkEstatus($status);
            $tourList->setFecModificacion(new \DateTime('now'));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tourList);
            $entityManager->flush();
            return $this->json([
                'message' => "SUCCESS"
            ]);
        }else{
            if ($requestBody['exit'] != 0 && $requestBody['entry'] == 0 && $requestBody['exitVerify'] == 0) {
                //salida
                $repositoryStatus = $this->getDoctrine()->getRepository(Estatus::class);
                $status = $repositoryStatus->findOneBy([
                    'idEstatus' => 17
                ]);
                $tourList->setFkEstatus($status);
                $tourList->setKilometrajeSalida($requestBody['exit']);
                $tourList->setHoraSalida(new \DateTime('now'));
                $tourList->setFecModificacion(new \DateTime('now'));
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($tourList);
                $entityManager->flush();
                return $this->json([
                    'message' => "SUCCESS"
                ]);
            }
            if ($requestBody['exit'] != 0 && $requestBody['entry'] == 0 && $requestBody['exitVerify'] == 1) {
                //salida
                $repositoryStatus = $this->getDoctrine()->getRepository(Estatus::class);
                $status = $repositoryStatus->findOneBy([
                    'idEstatus' => 22
                ]);
                $tourList->setFkEstatus($status);
                $tourList->setFecModificacion(new \DateTime('now'));
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($tourList);
                $entityManager->flush();
                return $this->json([
                    'message' => "SUCCESS"
                ]);
            }
            if ($requestBody['exit'] != 0 && $requestBody['entry'] != 0) {
                //llegada
                $repositoryStatus = $this->getDoctrine()->getRepository(Estatus::class);
                $status = $repositoryStatus->findOneBy([
                    'idEstatus' => 18
                ]);
                $tourList->setFkEstatus($status);
                $tourList->setKilometrajeLlegada($requestBody['entry']);
                $tourList->setHoraLlegada(new \DateTime('now'));
                $tourList->setFecModificacion(new \DateTime('now'));
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($tourList);
                $entityManager->flush();
                return $this->json([
                    'message' => "SUCCESS"
                ]);
            }
        }
        
    
    }

    public function getListaRecorrido(): Response{

        $request = Request::createFromGlobals();
        
        $decoded = $this->authService->validateRequest($request);
        if (gettype($decoded) == 'array' && isset($decoded['error'])) {
            return $this->json($decoded);
        }

        $connection = $this->getDoctrine()->getConnection();
        $sql = 'SELECT * FROM lista_recorrido';
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

    public function getTourListTotal($num): Response{

        $request = Request::createFromGlobals();
        
        $decoded = $this->authService->validateRequest($request);
        if (gettype($decoded) == 'array' && isset($decoded['error'])) {
            return $this->json($decoded);
        }

        $connection = $this->getDoctrine()->getConnection();
        $sql = 'SELECT COUNT(lista_recorrido.ID_LISTA_RECORRIDO) AS total, 
        ruta.NB_RUTA AS ruta, 
        oficina.NB_OFICINA as oficina, 
        lista_recorrido.NRO_LISTA AS numeroLista,
        lista_recorrido.ID_LISTA_RECORRIDO AS idLista
        FROM persona 
        LEFT JOIN tripulante
        ON persona.ID_PERSONA = tripulante.FK_PERSONA
        LEFT JOIN lista_recorrido
        ON lista_recorrido.ID_LISTA_RECORRIDO = tripulante.FK_LISTA_RECORRIDO
        LEFT JOIN ruta
        ON lista_recorrido.FK_RUTA = ruta.ID_RUTA
        LEFT JOIN oficina
        ON ruta.FK_OFICINA = oficina.ID_OFICINA
        WHERE lista_recorrido.FEC_LISTA = CURRENT_DATE() AND persona.NUM_EMPLEADO ='.$num.';';
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
}
