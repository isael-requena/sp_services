<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Service\SerializerService;


use App\Entity\Alcance;

class CiudadController extends AbstractController {
    private $serializerService;

    public function __construct(SerializerService $serializerService) {
        $this->serializerService = $serializerService;
    }

    
    public function getCity(): Response{

        $request = Request::createFromGlobals();

        $connection = $this->getDoctrine()->getConnection();
        $sql = 'SELECT * FROM ciudad';
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
