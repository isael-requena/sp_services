<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Service\SerializerService;
use App\Service\AuthService;

class RutaController extends AbstractController{
    public function __construct(SerializerService $serializerService, AuthService $authService) {
        $this->serializerService = $serializerService;
        $this->authService = $authService;
    }

    public function getRutas(): Response{

        $request = Request::createFromGlobals();
        
        /*$decoded = $this->authService->validateRequest($request);
        if (gettype($decoded) == 'array' && isset($decoded['error'])) {
            return $this->json($decoded);
        }*/

        $connection = $this->getDoctrine()->getConnection();
        $sql = 'SELECT * FROM ruta';
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

    public function getMontosRuta($alcance, $entidad): Response{

        $request = Request::createFromGlobals();
        
        $decoded = $this->authService->validateRequest($request);
        if (gettype($decoded) == 'array' && isset($decoded['error'])) {
            return $this->json($decoded);
        }

        $connection = $this->getDoctrine()->getConnection();
        $sql = "SELECT ruta.ID_RUTA
        ,ruta.NB_RUTA
        ,oficina.ID_OFICINA
        ,oficina.NB_OFICINA
        ,region.ID_REGION
        ,region.NB_REGION
        ,FORMAT(lista_recorrido.HORA_SALIDA, 'dd-MM-yyyy hh:mm:ss') as HORA_SALIDA
        ,FORMAT(lista_recorrido.HORA_LLEGADA, 'dd-MM-yyyy hh:mm:ss') as HORA_LLEGADA
        
		,comprobantes.CANTIDAD_POR_ENTREGAR
		,comprobantes.MONTO_POR_ENTREGAR
		,comprobantes.CANTIDAD_ENTREGADO
		,comprobantes.MONTO_ENTREGADO
		,comprobantes.CANTIDAD_DEVUELTO
		,comprobantes.MONTO_DEVUELTO
		,comprobantes.CANTIDAD_RECOGIDO
		,comprobantes.MONTO_RECOGIDO
        
        ,puntos.PUNTO_PENDIENTE
        ,puntos.PUNTO_EJECUTADO
        ,puntos.PUNTO_PLANIFICADO
        
        ,ISNULL(eventos_punto.EVENTOS, 0) as EVENTOS_PUNTO
        ,ISNULL(eventos_punto.EVENTOS_CLIENTE, 0) as EVENTOS_CLIENTE_PUNTO
        ,ISNULL(eventos_punto.EVENTOS_EMPRESA, 0) as EVENTOS_EMPRESA_PUNTO
        ,ISNULL(eventos_cs.EVENTOS, 0) as EVENTOS_CS
        ,ISNULL(eventos_cs.EVENTOS_CLIENTE, 0) as EVENTOS_CLIENTE_CS
        ,ISNULL(eventos_cs.EVENTOS_EMPRESA, 0) as EVENTOS_EMPRESA_CS

        ,FORMAT(log_bdm.FECHA_CREACION, 'dd-MM-yyyy hh:mm:ss') as FECHA_PUNTO_MOSTRAR
        ,log_bdm.FECHA_CREACION as FECHA_PUNTO
        
        FROM ruta as ruta
        LEFT JOIN oficina as oficina
        ON ruta.FK_OFICINA = oficina.ID_OFICINA
        LEFT JOIN region as region
        ON oficina.FK_REGION = region.ID_REGION
        LEFT JOIN lista_recorrido as lista_recorrido
        ON lista_recorrido.FK_RUTA = ruta.ID_RUTA
        LEFT JOIN (SELECT MAX(FECHA_CREACION) as FECHA_CREACION 
        ,FK_LISTA_RECORRIDO
        FROM log_bdm as log_bdm
        WHERE FK_LISTA_RECORRIDO IS NOT NULL
        GROUP BY FK_LISTA_RECORRIDO) as log_bdm
        ON log_bdm.FK_LISTA_RECORRIDO = lista_recorrido.ID_LISTA_RECORRIDO
        LEFT JOIN (SELECT lista_recorrido.ID_LISTA_RECORRIDO
                   ,COUNT(punto_lr.ID_PUNTO_LR) as EVENTOS 
                   ,SUM(CASE WHEN causa_no_ejecucion_punto.IMPUTABLE = 'C' THEN 1 ELSE 0 END) as EVENTOS_CLIENTE
                   ,SUM(CASE WHEN causa_no_ejecucion_punto.IMPUTABLE = 'E' THEN 1 ELSE 0 END) as EVENTOS_EMPRESA
                   FROM punto_lr as punto_lr 
                   JOIN lista_recorrido as lista_recorrido
                   ON lista_recorrido.ID_LISTA_RECORRIDO = punto_lr.FK_LISTA_RECORRIDO
                   JOIN ruta as ruta
                   ON lista_recorrido.FK_RUTA = ruta.ID_RUTA
                   LEFT JOIN causa_no_ejecucion as causa_no_ejecucion_punto
                   ON causa_no_ejecucion_punto.ID_CAUSA_NO_EJECUCION = punto_lr.FK_CAUSA_NO_EJECUCION
                   WHERE punto_lr.FK_CAUSA_NO_EJECUCION IS NOT NULL
                   GROUP BY lista_recorrido.ID_LISTA_RECORRIDO) as eventos_punto 
        ON eventos_punto.ID_LISTA_RECORRIDO = lista_recorrido.ID_LISTA_RECORRIDO
        LEFT JOIN (SELECT lista_recorrido.ID_LISTA_RECORRIDO
				   ,COUNT(cs_punto_lr.ID) as EVENTOS 
                   ,SUM(CASE WHEN causa_no_ejecucion_cs.IMPUTABLE = 'C' THEN 1 ELSE 0 END) as EVENTOS_CLIENTE
                   ,SUM(CASE WHEN causa_no_ejecucion_cs.IMPUTABLE = 'E' THEN 1 ELSE 0 END) as EVENTOS_EMPRESA
                   FROM cs_punto_lr as cs_punto_lr
                   JOIN punto_lr as punto_lr 
                   ON cs_punto_lr.FK_PUNTOLR = punto_lr.ID_PUNTO_LR
                   LEFT JOIN causa_no_ejecucion as causa_no_ejecucion_cs
                   ON causa_no_ejecucion_cs.ID_CAUSA_NO_EJECUCION = cs_punto_lr.FK_CAUSA_NO_EJECUCION
                   JOIN lista_recorrido as lista_recorrido
                   ON lista_recorrido.ID_LISTA_RECORRIDO = punto_lr.FK_LISTA_RECORRIDO
                   JOIN ruta as ruta
                   ON lista_recorrido.FK_RUTA = ruta.ID_RUTA
                   WHERE cs_punto_lr.FK_CAUSA_NO_EJECUCION IS NOT NULL
                   GROUP BY lista_recorrido.ID_LISTA_RECORRIDO) as eventos_cs 
        ON eventos_cs.ID_LISTA_RECORRIDO = lista_recorrido.ID_LISTA_RECORRIDO
        LEFT JOIN (SELECT lista_recorrido.ID_LISTA_RECORRIDO
                   ,SUM(CASE WHEN punto_lr.FK_ESTATUS in (4,5,6,7) AND punto_lr.FK_CAUSA_NO_EJECUCION IS NULL THEN 1 ELSE 0 END) as PUNTO_PENDIENTE
                   ,SUM(CASE WHEN punto_lr.FK_ESTATUS = 8 AND punto_lr.FK_CAUSA_NO_EJECUCION IS NULL THEN 1 ELSE 0 END) as PUNTO_EJECUTADO
                   ,COUNT(punto_lr.ID_PUNTO_LR) as PUNTO_PLANIFICADO
                   FROM punto_lr as punto_lr 
                   JOIN lista_recorrido as lista_recorrido
                   ON lista_recorrido.ID_LISTA_RECORRIDO = punto_lr.FK_LISTA_RECORRIDO
                   GROUP BY lista_recorrido.ID_LISTA_RECORRIDO) as puntos
        ON puntos.ID_LISTA_RECORRIDO = lista_recorrido.ID_LISTA_RECORRIDO 
		LEFT JOIN (SELECT lista_recorrido.ID_LISTA_RECORRIDO
        ,SUM(CASE WHEN (cs_punto_lr.FK_ESTATUS = 10 AND punto_lr.FK_CAUSA_NO_EJECUCION IS NULL) OR (cs_punto_lr.FK_ESTATUS = 11 AND cs_punto_lr.FK_TIPO_OPERACION = 1) THEN comprobante_servicio.CANT_ENVASES ELSE 0 END) as CANTIDAD_POR_ENTREGAR
        ,SUM(CASE WHEN (cs_punto_lr.FK_ESTATUS = 10 AND punto_lr.FK_CAUSA_NO_EJECUCION IS NULL) OR (cs_punto_lr.FK_ESTATUS = 11 AND cs_punto_lr.FK_TIPO_OPERACION = 1) THEN (comprobante_servicio.DICE_CONTENER*ISNULL(tasa_cambio.TASA,1))/dolares.TASA ELSE 0 END) as MONTO_POR_ENTREGAR
        
        ,SUM(CASE WHEN (cs_punto_lr.FK_ESTATUS = 12 AND punto_lr.FK_CAUSA_NO_EJECUCION IS NULL) THEN comprobante_servicio.CANT_ENVASES ELSE 0 END) as CANTIDAD_ENTREGADO
        ,SUM(CASE WHEN (cs_punto_lr.FK_ESTATUS = 12 AND punto_lr.FK_CAUSA_NO_EJECUCION IS NULL) THEN (comprobante_servicio.DICE_CONTENER*ISNULL(tasa_cambio.TASA,1))/dolares.TASA ELSE 0 END) as MONTO_ENTREGADO
        
        ,SUM(CASE WHEN cs_punto_lr.FK_ESTATUS = 13 OR ((cs_punto_lr.FK_ESTATUS = 12 OR cs_punto_lr.FK_ESTATUS = 10) AND punto_lr.FK_CAUSA_NO_EJECUCION IS NOT NULL) THEN comprobante_servicio.CANT_ENVASES ELSE 0 END) as CANTIDAD_DEVUELTO
        ,SUM(CASE WHEN cs_punto_lr.FK_ESTATUS = 13 OR ((cs_punto_lr.FK_ESTATUS = 12 OR cs_punto_lr.FK_ESTATUS = 10) AND punto_lr.FK_CAUSA_NO_EJECUCION IS NOT NULL) THEN (comprobante_servicio.DICE_CONTENER*ISNULL(tasa_cambio.TASA,1))/dolares.TASA ELSE 0 END) as MONTO_DEVUELTO
        
        ,SUM(CASE WHEN (cs_punto_lr.FK_ESTATUS = 14 AND punto_lr.FK_CAUSA_NO_EJECUCION IS NULL) THEN comprobante_servicio.CANT_ENVASES ELSE 0 END) as CANTIDAD_RECOGIDO
        ,SUM(CASE WHEN (cs_punto_lr.FK_ESTATUS = 14 AND punto_lr.FK_CAUSA_NO_EJECUCION IS NULL) THEN (comprobante_servicio.DICE_CONTENER*ISNULL(tasa_cambio.TASA,1))/dolares.TASA ELSE 0 END) as MONTO_RECOGIDO

        FROM lista_recorrido as lista_recorrido
        JOIN punto_lr as punto_lr 
        ON punto_lr.FK_LISTA_RECORRIDO = lista_recorrido.ID_LISTA_RECORRIDO
        LEFT JOIN cs_punto_lr as cs_punto_lr
        ON cs_punto_lr.FK_PUNTOLR = punto_lr.ID_PUNTO_LR
        LEFT JOIN comprobante_servicio as comprobante_servicio
        ON cs_punto_lr.FK_COMPROBANTE_SERVICIO = comprobante_servicio.ID_COMPROBANTE_SERVICIO
        LEFT JOIN tipo_moneda as tipo_moneda
        ON tipo_moneda.ID_TIPO_MONEDA = comprobante_servicio.FK_TIPO_MONEDA
        LEFT JOIN tasa_cambio as dolares
        ON dolares.MONEDA = 2
        LEFT JOIN tasa_cambio as tasa_cambio
        ON tipo_moneda.COD_MONEDA = tasa_cambio.MONEDA
        WHERE lista_recorrido.HORA_SALIDA IS NOT NULL AND lista_recorrido.FEC_LISTA = CONVERT(DATE, CURRENT_TIMESTAMP)
		GROUP BY lista_recorrido.ID_LISTA_RECORRIDO) as comprobantes
        ON comprobantes.ID_LISTA_RECORRIDO = lista_recorrido.ID_LISTA_RECORRIDO
        WHERE lista_recorrido.HORA_SALIDA IS NOT NULL ";
        $sql .= " AND lista_recorrido.FEC_LISTA = CONVERT(DATE, CURRENT_TIMESTAMP) ";
        if($alcance==3){
            $sql .= " AND region.ID_REGION = ".$entidad;
        }
        if($alcance==2){
            $sql .= " AND oficina.ID_OFICINA = ".$entidad;
        }
        if($alcance==1){
            $sql .= " AND ruta.ID_RUTA = ".$entidad;
        }
        #$sql .= " GROUP BY ruta.ID_RUTA;";
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
