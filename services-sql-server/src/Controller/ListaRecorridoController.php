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
use App\Entity\Usuario;

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
        if ($requestBody['exit'] == 0) {
            //search user
            $repository = $this->getDoctrine()->getRepository(Usuario::class);
            $user = $repository->findOneBy([
                'id' => $requestBody['user_id']
            ]);
            if ($user) {
                $user->setConectado(1);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();
            }else{
                return $this->json([
                    'message' => "USER_NOT_FOUND"
                ]);
            }
            //salida
            $repositoryStatus = $this->getDoctrine()->getRepository(Estatus::class);
            $status = $repositoryStatus->findOneBy([
                'idEstatus' => 21
            ]);
            $tourList->setFkEstatus($status);
            $date = new \DateTime('now');
            $dateModify = $date->format('Y-m-d H:i:s');
            $tourList->setFecModificacion($dateModify);
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
                $date = new \DateTime('now');
                $dateModify = $date->format('Y-m-d H:i:s');
                $tourList->setHoraSalida($dateModify);
                $tourList->setFecModificacion($dateModify);
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
                $date = new \DateTime('now');
                $dateModify = $date->format('Y-m-d H:i:s');
                $tourList->setFecModificacion($dateModify);
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
                $date = new \DateTime('now');
                $dateModify = $date->format('Y-m-d H:i:s');
                $tourList->setHoraLlegada($dateModify);
                $tourList->setFecModificacion($dateModify);
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
        $sql = 'SELECT 
        (SELECT COUNT(*)
         FROM lista_recorrido
         LEFT JOIN tripulante ON lista_recorrido.ID_LISTA_RECORRIDO = tripulante.FK_LISTA_RECORRIDO
         LEFT JOIN persona ON tripulante.FK_PERSONA = persona.ID_PERSONA AND tripulante.FK_ROL = 1
         WHERE lista_recorrido.FEC_LISTA = CONVERT(DATE, CURRENT_TIMESTAMP) AND lista_recorrido.FK_ESTATUS = 19
         AND persona.NUM_EMPLEADO = '.$num.') AS total,
        ruta.NB_RUTA AS ruta, 
        oficina.NB_OFICINA AS oficina,
        lista_recorrido.NRO_LISTA AS numeroLista,
        lista_recorrido.ID_LISTA_RECORRIDO AS idLista
        FROM ruta 
        LEFT JOIN oficina ON ruta.FK_OFICINA = oficina.ID_OFICINA
        LEFT JOIN lista_recorrido ON lista_recorrido.FK_RUTA = ruta.ID_RUTA
        LEFT JOIN tripulante ON lista_recorrido.ID_LISTA_RECORRIDO = tripulante.FK_LISTA_RECORRIDO
        LEFT JOIN persona ON tripulante.FK_PERSONA = persona.ID_PERSONA AND tripulante.FK_ROL = 1 
        WHERE lista_recorrido.FEC_LISTA = CONVERT(DATE, CURRENT_TIMESTAMP) AND lista_recorrido.FK_ESTATUS = 19
        AND persona.NUM_EMPLEADO = '.$num.'
        ORDER BY ruta.NB_RUTA ASC, oficina.NB_OFICINA ASC;';
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


    public function getTourListMultipleAssistants($id): Response{

        $request = Request::createFromGlobals();
        
        $decoded = $this->authService->validateRequest($request);
        if (gettype($decoded) == 'array' && isset($decoded['error'])) {
            return $this->json($decoded);
        }

        $connection = $this->getDoctrine()->getConnection();
        $sql = 'SELECT	 
        lista_recorrido.ID_LISTA_RECORRIDO,
        persona.NUM_EMPLEADO
        FROM persona 
        LEFT JOIN tripulante
        ON persona.ID_PERSONA = tripulante.FK_PERSONA AND tripulante.FK_ROL = 1
        LEFT JOIN lista_recorrido
        ON lista_recorrido.ID_LISTA_RECORRIDO = tripulante.FK_LISTA_RECORRIDO
        WHERE lista_recorrido.FEC_LISTA = CONVERT(DATE, CURRENT_TIMESTAMP) AND lista_recorrido.ID_LISTA_RECORRIDO = '.$id.';';

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
