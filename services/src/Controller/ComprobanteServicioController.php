<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Service\SerializerService;
use App\Service\AuthService;

class ComprobanteServicioController extends AbstractController{
    public function __construct(SerializerService $serializerService, AuthService $authService) {
        $this->serializerService = $serializerService;
        $this->authService = $authService;
    }

    public function getComprobantesServicio($alcance, $entidad): Response{

        $request = Request::createFromGlobals();
        
        $decoded = $this->authService->validateRequest($request);
        if (gettype($decoded) == 'array' && isset($decoded['error'])) {
            return $this->json($decoded);
        }

        $connection = $this->getDoctrine()->getConnection();
        $sql = 'SELECT 	p.ID_PUNTO
        ,punto_lr.ID_PUNTO_LR
		,p.NOMBRE_PUNTO
        ,p.COD_PUNTO
		,lr.ID_LISTA_RECORRIDO
        ,lr.NRO_LISTA
        ,date_format(lr.HORA_SALIDA, "%d-%m-%Y %T") as HORA_SALIDA
        ,date_format(lr.HORA_LLEGADA, "%d-%m-%Y %T") as HORA_LLEGADA
        ,lr.FEC_LISTA
        ,(CASE WHEN lr.HORA_SALIDA IS NOT NULL AND lr.HORA_LLEGADA IS NULL THEN 1 ELSE 2 END) as TIPO_LR
        ,punto_lr.FK_ESTATUS as ESTATUS_PUNTO
        ,causa_no_ejecucion_punto.IMPUTABLE as CAUSA_NO_EJECUCION_PUNTO
        ,causa_no_ejecucion_punto.DESCRIPCION as DESCRIPCION_CAUSA_NO_EJECUCION_PUNTO
        ,cs.ID_COMPROBANTE_SERVICIO
        ,cs.COD_CS
        ,IFNULL(cs.CANT_ENVASES, 0) as CANT_ENVASES
        ,IFNULL(cs.DICE_CONTENER, 0) as DICE_CONTENER
        ,cs.COD_CLIENTE
        ,cs.COD_ORIGEN
        ,cs.COD_DESTINO
        ,cs_punto_lr.FK_ESTATUS as ESTATUS_CS
        ,cs_punto_lr.FK_TIPO_OPERACION
        ,causa_no_ejecucion_cs.IMPUTABLE as CAUSA_NO_EJECUCION_CS
        ,causa_no_ejecucion_cs.DESCRIPCION as DESCRIPCION_CAUSA_NO_EJECUCION_CS
        ,tipo_moneda.COD_MONEDA
        ,tipo_moneda.DENOMINACION
        ,tipo_moneda.NB_TIPO_MONEDA
        ,tipo_valor.COD_VALOR
        ,tipo_valor.NB_TIPO_VALOR
        ,ruta.ID_RUTA
        ,ruta.NB_RUTA
        ,oficina.ID_OFICINA
        ,oficina.NB_OFICINA
        ,region.ID_REGION
        ,region.NB_REGION
        #,IFNULL(tracking_cs.FK_ESTATUS, "Pendiente") as ESTATUS_CS
        #,IFNULL(tracking_punto.FK_ESTATUS, "Pendiente") as ESTATUS_PUNTO
        FROM punto_lr as punto_lr
        JOIN punto as p 
        ON p.ID_PUNTO = punto_lr.FK_PUNTO
        JOIN lista_recorrido as lr 
        ON lr.ID_LISTA_RECORRIDO = punto_lr.FK_LISTA_RECORRIDO
        JOIN ruta as ruta 
        ON ruta.ID_RUTA = lr.FK_RUTA
        JOIN oficina as oficina
        ON ruta.FK_OFICINA = oficina.ID_OFICINA
        JOIN region as region
        ON oficina.FK_REGION = region.ID_REGION
        LEFT JOIN cs_punto_lr as cs_punto_lr
        ON cs_punto_lr.FK_PUNTOLR = punto_lr.ID_PUNTO_LR
        LEFT JOIN comprobante_servicio as cs 
        ON cs.ID_COMPROBANTE_SERVICIO = cs_punto_lr.FK_COMPROBANTE_SERVICIO
        LEFT JOIN causa_no_ejecucion as causa_no_ejecucion_punto
        ON causa_no_ejecucion_punto.ID_CAUSA_NO_EJECUCION = punto_lr.FK_CAUSA_NO_EJECUCION
        LEFT JOIN causa_no_ejecucion as causa_no_ejecucion_cs
        ON causa_no_ejecucion_cs.ID_CAUSA_NO_EJECUCION = cs_punto_lr.FK_CAUSA_NO_EJECUCION
        LEFT JOIN tipo_moneda as tipo_moneda 
        ON tipo_moneda.ID_TIPO_MONEDA = cs.FK_TIPO_MONEDA
        LEFT JOIN tipo_valor as tipo_valor
        ON tipo_valor.ID_TIPO_VALOR = cs.FK_TIPO_VALOR
        WHERE lr.HORA_SALIDA IS NOT NULL ';
        $sql .= ' AND date_format(lr.FEC_LISTA, "%Y-%m-%d") = CURRENT_DATE() ';
        if($alcance==3){
            $sql .= ' AND region.ID_REGION = '.$entidad;
        }
        if($alcance==2){
            $sql .= ' AND oficina.ID_OFICINA = '.$entidad;
        }
        if($alcance==1){
            $sql .= ' AND ruta.ID_RUTA = '.$entidad;
        }
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
