<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Service\SerializerService;
use App\Service\AuthService;

class LogController extends AbstractController{
    public function __construct(SerializerService $serializerService, AuthService $authService) {
        $this->serializerService = $serializerService;
        $this->authService = $authService;
    }

    public function getLog(): Response{

        $request = Request::createFromGlobals();
        
        $decoded = $this->authService->validateRequest($request);
        if (gettype($decoded) == 'array' && isset($decoded['error'])) {
            return $this->json($decoded);
        }

        $connection = $this->getDoctrine()->getConnection();
        $sql = "SELECT log_rm.ID_LOG_RM
        ,log_rm.USUARIO_CREACION
        ,FORMAT(log_rm.FECHA, 'dd-MM-yyyy hh:mm:ss') as FECHA
        ,log_rm.ENTIDAD
        ,log_rm.ID_REGISTRO
        ,log_tipo.DESCRIPCION
        
        ,(CASE WHEN CLIENTE.RIF IS NOT NULL THEN CLIENTE.RIF 
        WHEN COMPROBANTE_SERVICIO.COD_CS IS NOT NULL THEN COMPROBANTE_SERVICIO.COD_CS 
        WHEN TRANSPORTE.COD_UNIDAD IS NOT NULL THEN TRANSPORTE.COD_UNIDAD 
        --WHEN LISTA_RECORRIDO.NRO_LISTA IS NOT NULL THEN CONCAT(CONCAT(CONCAT('N°',LISTA_RECORRIDO.NRO_LISTA), ' - '), LISTA_RECORRIDO.FEC_LISTA)
        WHEN LISTA_RECORRIDO.NRO_LISTA IS NOT NULL THEN CONCAT(CONCAT(CONCAT(CONCAT(CONCAT(CONCAT(LISTA_RECORRIDO.COD_OFICINA, ' - '),LISTA_RECORRIDO.COD_RUTA), ' - '),LISTA_RECORRIDO.FEC_LISTA), ' - '),LISTA_RECORRIDO.NRO_LISTA)
        WHEN OFICINA.NB_OFICINA IS NOT NULL THEN OFICINA.NB_OFICINA 
        WHEN REGION.NB_REGION IS NOT NULL THEN REGION.NB_REGION 
        WHEN CS_PUNTO_LR.ID IS NOT NULL THEN CONVERT(VARCHAR, CS_PUNTO_LR.ID) 
        WHEN PUNTO_LR.ID_PUNTO_LR IS NOT NULL THEN CONVERT(VARCHAR, PUNTO_LR.ID_PUNTO_LR)
        WHEN USUARIO.NB_USUARIO IS NOT NULL THEN USUARIO.NB_USUARIO 
        WHEN log_rm.ID_REGISTRO = 0 THEN log_rm.ENTIDAD 
        WHEN TRIPULANTE.NUM_EMPLEADO IS NOT NULL THEN TRIPULANTE.NUM_EMPLEADO END) AS REGISTRO
        
        --,(CASE WHEN CLIENTE.DENOMINACION_COMERCIAL IS NOT NULL THEN CLIENTE.DENOMINACION_COMERCIAL WHEN LISTA_RECORRIDO.FEC_LISTA IS NOT NULL THEN LISTA_RECORRIDO.FEC_LISTA END) AS REGISTRO_SECUNDARIO
        
        --,CAUSA_NO_EJECUCION.DESCRIPCION
        --,TASA_CAMBIO.MONEDA
        --,TASA_CAMBIO.TASA
        --,TIPO_MONEDA.COD_MONEDA
        --,TIPO_MONEDA.DENOMINACION
        --,TIPO_VALOR.NB_TIPO_VALOR
        --,EMPLEADOS.NUM_EMPLEADO
        --,COMPANIA.NB_CORTO_COMPANIA
        --,ESTADO.NB_ESTADO
        --,RUTA.NB_RUTA
        --,PUNTO.NOMBRE_PUNTO
        --,MUNICIPIO.NB_MUNICIPIO
        --,PAIS.NB_PAIS
        --,CIUDAD.COD_CIUDAD
        --,CIUDAD.NB_CIUDAD
        --,PERSONA.NUM_EMPLEADO
        
        FROM log_rm as log_rm
        JOIN log_tipo as log_tipo
        ON log_tipo.ID_LOG_TIPO = log_rm.FK_LOG_TIPO
        
        LEFT JOIN CAUSA_NO_EJECUCION AS CAUSA_NO_EJECUCION
        ON CAUSA_NO_EJECUCION.ID_CAUSA_NO_EJECUCION = log_rm.ID_REGISTRO AND log_rm.ENTIDAD = 'CAUSA_NO_EJECUCION'
        
        LEFT JOIN CIUDAD AS CIUDAD
        ON CIUDAD.ID_CIUDAD = log_rm.ID_REGISTRO AND log_rm.ENTIDAD = 'CIUDAD'
        
        LEFT JOIN CLIENTE AS CLIENTE
        ON CLIENTE.ID_CLIENTE = log_rm.ID_REGISTRO AND log_rm.ENTIDAD = 'CLIENTE'
        
        LEFT JOIN COMPANIA AS COMPANIA
        ON COMPANIA.ID_COMPANIA = log_rm.ID_REGISTRO AND log_rm.ENTIDAD = 'COMPANIA'
        
        LEFT JOIN COMPROBANTE_SERVICIO AS COMPROBANTE_SERVICIO
        ON COMPROBANTE_SERVICIO.ID_COMPROBANTE_SERVICIO = log_rm.ID_REGISTRO AND log_rm.ENTIDAD = 'COMPROBANTE_SERVICIO'
        
        LEFT JOIN CS_PUNTO_LR AS CS_PUNTO_LR
        ON CS_PUNTO_LR.ID = log_rm.ID_REGISTRO AND log_rm.ENTIDAD = 'CS_PUNTO_LR'
        
        LEFT JOIN EMPLEADOS AS EMPLEADOS
        ON EMPLEADOS.ID_EMPLEADO = log_rm.ID_REGISTRO AND log_rm.ENTIDAD = 'EMPLEADOS'
        
        LEFT JOIN ESTADO AS ESTADO
        ON ESTADO.ID_ESTADO = log_rm.ID_REGISTRO AND log_rm.ENTIDAD = 'ESTADO'
        
        LEFT JOIN (SELECT LISTA_RECORRIDO.ID_LISTA_RECORRIDO
            ,LISTA_RECORRIDO.NRO_LISTA
            ,LISTA_RECORRIDO.FEC_LISTA
            ,LISTA_RECORRIDO.FK_RUTA
            ,RUTA.COD_RUTA
            ,OFICINA.COD_OFICINA
            ,RUTA.NB_RUTA
            ,OFICINA.NB_OFICINA
            FROM LISTA_RECORRIDO AS LISTA_RECORRIDO
            LEFT JOIN RUTA AS RUTA
            ON RUTA.ID_RUTA = LISTA_RECORRIDO.FK_RUTA
            LEFT JOIN OFICINA AS OFICINA
            ON OFICINA.ID_OFICINA = RUTA.FK_OFICINA) AS LISTA_RECORRIDO
        ON LISTA_RECORRIDO.ID_LISTA_RECORRIDO = log_rm.ID_REGISTRO AND log_rm.ENTIDAD = 'LISTA_RECORRIDO'
        
        LEFT JOIN MUNICIPIO AS MUNICIPIO
        ON MUNICIPIO.ID_MUNICIPIO = log_rm.ID_REGISTRO AND log_rm.ENTIDAD = 'MUNICIPIO'
        
        LEFT JOIN OFICINA AS OFICINA
        ON OFICINA.ID_OFICINA = log_rm.ID_REGISTRO AND log_rm.ENTIDAD = 'OFICINA'
        
        LEFT JOIN PAIS AS PAIS
        ON PAIS.ID_PAIS = log_rm.ID_REGISTRO AND log_rm.ENTIDAD = 'PAIS'
        
        LEFT JOIN PERSONA AS PERSONA
        ON PERSONA.ID_PERSONA = log_rm.ID_REGISTRO AND log_rm.ENTIDAD = 'PERSONA'
        
        LEFT JOIN PUNTO AS PUNTO
        ON PUNTO.ID_PUNTO = log_rm.ID_REGISTRO AND log_rm.ENTIDAD = 'PUNTO'
        
        LEFT JOIN PUNTO_LR AS PUNTO_LR
        ON PUNTO_LR.ID_PUNTO_LR = log_rm.ID_REGISTRO AND log_rm.ENTIDAD = 'PUNTO_LR'
        
        LEFT JOIN REGION AS REGION
        ON REGION.ID_REGION = log_rm.ID_REGISTRO AND log_rm.ENTIDAD = 'REGION'
        
        LEFT JOIN RUTA AS RUTA
        ON RUTA.ID_RUTA = log_rm.ID_REGISTRO AND log_rm.ENTIDAD = 'RUTA'
        
        LEFT JOIN TASA_CAMBIO AS TASA_CAMBIO
        ON TASA_CAMBIO.ID_TASA_CAMBIO = log_rm.ID_REGISTRO AND log_rm.ENTIDAD = 'TASA_CAMBIO'
        
        LEFT JOIN TIPO_MONEDA AS TIPO_MONEDA
        ON TIPO_MONEDA.ID_TIPO_MONEDA = log_rm.ID_REGISTRO AND log_rm.ENTIDAD = 'TIPO_MONEDA'
        
        LEFT JOIN TIPO_VALOR AS TIPO_VALOR
        ON TIPO_VALOR.ID_TIPO_VALOR = log_rm.ID_REGISTRO AND log_rm.ENTIDAD = 'TIPO_VALOR'
        
        LEFT JOIN TRANSPORTE AS TRANSPORTE
        ON TRANSPORTE.ID_TRANSPORTE = log_rm.ID_REGISTRO AND log_rm.ENTIDAD = 'TRANSPORTE'

        LEFT JOIN USUARIO AS USUARIO
        ON USUARIO.ID = log_rm.ID_REGISTRO AND log_rm.ENTIDAD = 'USUARIO'
        
        LEFT JOIN TRIPULANTE AS TRIPULANTE
        ON TRIPULANTE.ID_TRIPULANTE = log_rm.ID_REGISTRO AND log_rm.ENTIDAD = 'TRIPULANTE'
        WHERE (log_rm.ENTIDAD IN ('LISTA_RECORRIDO'
        ,'OFICINA'
        ,'REGION'
        ,'USUARIO') OR log_rm.USUARIO_CREACION = 'ETL_I');";
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

    public function getLogPanico($alcance, $entidad): Response{

        $request = Request::createFromGlobals();
        
        $decoded = $this->authService->validateRequest($request);
        if (gettype($decoded) == 'array' && isset($decoded['error'])) {
            return $this->json($decoded);
        }

        $connection = $this->getDoctrine()->getConnection();
        $sql = "SELECT 	log_panico.ID_LOG_PANICO
        ,log_panico.FEC_CREACION
        ,log_panico.LISTA_RECORRIDO
        ,log_panico.USUARIO_CREACION
        ,log_panico.FEC_PUNTO as FEC_MODIFICACION
		,ISNULL(estatus.NB_ESTATUS, '-') as NB_ESTATUS

		,lista_recorrido.NRO_LISTA

        ,punto_lr.COD_PUNTO
        ,ISNULL(punto_lr.NOMBRE_PUNTO, '-') as NOMBRE_PUNTO
        ,ISNULL(punto_lr.VIA, '-') as VIA
        ,ISNULL(punto_lr.CENTRO_POB, '-') as CENTRO_POB
        ,ISNULL(punto_lr.EDIFICACION, '-') as EDIFICACION
        ,ISNULL(punto_lr.OFICINA, '-') as OFICINA
        ,ISNULL(punto_lr.PISO, '-') as PISO
        ,ISNULL(punto_lr.REFERENCIA, '-') as REFERENCIA
        ,ISNULL(punto_lr.ID_PUNTO_LR, '-') as ID_PUNTO_LR
        ,ISNULL(punto_lr.FK_ESTATUS, '-') as FK_ESTATUS
		,ISNULL(punto_lr.DENOMINACION_COMERCIAL, '-') as DENOMINACION_COMERCIAL

        ,lista_recorrido.NUM_EMPLEADO
        ,lista_recorrido.PRIMER_NOMBRE
        ,lista_recorrido.PRIMER_APELLIDO
        ,lista_recorrido.COD_UNIDAD

		,lista_recorrido.NB_RUTA
        ,lista_recorrido.COD_RUTA
        ,lista_recorrido.ID_OFICINA
        ,lista_recorrido.COD_OFICINA
        ,lista_recorrido.NB_OFICINA
        ,lista_recorrido.ID_REGION
        ,lista_recorrido.NB_REGION
        ,lista_recorrido.ID_COMPANIA
        ,lista_recorrido.COD_COMPANIA
        FROM log_panico as log_panico
		LEFT JOIN estatus as estatus 
        ON estatus.ID_ESTATUS = log_panico.ESTATUS_PUNTO

        LEFT JOIN (SELECT lista_recorrido.ID_LISTA_RECORRIDO
		,lista_recorrido.NRO_LISTA
		,lista_recorrido.HORA_LLEGADA
		,tripulante.NUM_EMPLEADO
        ,tripulante.PRIMER_NOMBRE
        ,tripulante.PRIMER_APELLIDO
        ,transporte.COD_UNIDAD

		,ruta.NB_RUTA
        ,ruta.COD_RUTA
        ,ruta.ID_OFICINA
        ,ruta.COD_OFICINA
        ,ruta.NB_OFICINA
        ,ruta.ID_REGION
        ,ruta.NB_REGION
        ,ruta.ID_COMPANIA
        ,ruta.COD_COMPANIA
		FROM lista_recorrido as lista_recorrido 
		LEFT JOIN (SELECT ruta.ID_RUTA
		,ruta.NB_RUTA
		,ruta.COD_RUTA
		,oficina.ID_OFICINA
        ,oficina.COD_OFICINA
        ,oficina.NB_OFICINA
        ,region.ID_REGION
        ,region.NB_REGION
        ,compania.ID_COMPANIA
        ,compania.COD_COMPANIA
		FROM ruta as ruta 
		LEFT JOIN oficina as oficina 
        ON ruta.FK_OFICINA = oficina.ID_OFICINA
        LEFT JOIN region as region 
        ON oficina.FK_REGION = region.ID_REGION
        LEFT JOIN compania as compania 
        ON oficina.FK_COMPANIA = compania.ID_COMPANIA) as ruta
        ON ruta.ID_RUTA = lista_recorrido.FK_RUTA

		LEFT JOIN (SELECT tripulante.NUM_EMPLEADO
		,tripulante.FK_ROL
		,tripulante.FK_LISTA_RECORRIDO
        ,persona.PRIMER_NOMBRE
        ,persona.PRIMER_APELLIDO
		FROM tripulante as tripulante 
		LEFT JOIN persona as persona 
        ON persona.NUM_EMPLEADO = tripulante.NUM_EMPLEADO 
		WHERE tripulante.FK_ROL = 1) as tripulante
        ON tripulante.FK_LISTA_RECORRIDO = lista_recorrido.ID_LISTA_RECORRIDO 
        
        LEFT JOIN transporte as transporte
        ON transporte.ID_TRANSPORTE = lista_recorrido.FK_TRANSPORTE) as lista_recorrido
        ON lista_recorrido.ID_LISTA_RECORRIDO = log_panico.LISTA_RECORRIDO
        
        LEFT JOIN (SELECT punto.COD_PUNTO
        ,ISNULL(punto.NOMBRE_PUNTO, '-') as NOMBRE_PUNTO
        ,ISNULL(punto.VIA, '-') as VIA
        ,ISNULL(punto.CENTRO_POB, '-') as CENTRO_POB
        ,ISNULL(punto.EDIFICACION, '-') as EDIFICACION
        ,ISNULL(punto.OFICINA, '-') as OFICINA
        ,ISNULL(punto.PISO, '-') as PISO
        ,ISNULL(punto.REFERENCIA, '-') as REFERENCIA
        ,ISNULL(punto_lr.ID_PUNTO_LR, '-') as ID_PUNTO_LR
        ,ISNULL(punto_lr.FK_ESTATUS, '-') as FK_ESTATUS
		,ISNULL(cliente.DENOMINACION_COMERCIAL, '-') as DENOMINACION_COMERCIAL
		FROM punto_lr as punto_lr
		LEFT JOIN punto as punto
        ON punto.ID_PUNTO = punto_lr.FK_PUNTO
        LEFT JOIN cliente as cliente 
        ON cliente.ID_CLIENTE = punto_lr.FK_CLIENTE) as punto_lr
        ON punto_lr.ID_PUNTO_LR = log_panico.FK_PUNTOLR

        WHERE lista_recorrido.HORA_LLEGADA IS NULL ";
        $sql .= ' AND CONVERT(DATE, log_panico.FEC_CREACION) = CONVERT(DATE, CURRENT_TIMESTAMP) ';
        if($alcance==3){
            $sql .= ' AND lista_recorrido.ID_REGION = '.$entidad;
        }
        if($alcance==2){
            $sql .= '  AND lista_recorrido.ID_OFICINA = '.$entidad;
        }
        if($alcance==1){
            $sql .= '  AND lista_recorrido.ID_RUTA = '.$entidad;
        }
        $sql .= ' ORDER BY log_panico.ID_LOG_PANICO DESC; ';
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
