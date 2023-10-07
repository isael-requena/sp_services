<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Service\SerializerService;
use App\Service\AuthService;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

use App\Entity\Usuario;
use App\Entity\ListaRecorrido;
use App\Entity\Tripulante;
use App\Entity\Membresia;
use App\Entity\Persona;

class UsuarioController extends AbstractController {
    const USER_NOT_FOUND = 'USER_NOT_FOUND';
    const INVALID_PASSWORD = 'INVALID_PASSWORD';
    const MOBILE_IDENTIFIER = 'MOBILE';
    const WEB_IDENTIFIER = 'WEB';
    const MOBILE_WEB_IDENTIFIER = 'MOBILE_WEB';
    const INVALID_PARAMS = 'INVALID_PARAMS';

    private $serializerService;

    public function __construct(SerializerService $serializerService, AuthService $authService) {
        $this->serializerService = $serializerService;
        $this->authService = $authService;
    }

    public function register(UserPasswordEncoderInterface $encoder){

        $request = Request::createFromGlobals();

        $decoded = $this->authService->validateRequest($request);
        if (gettype($decoded) == 'array' && isset($decoded['error'])) {
            return $this->json($decoded);
        }

        $requestBody = json_decode($request->getContent(), true);

        $user = new Usuario();
        $user->setUsername($requestBody['username']);
        $user->setNumEmpleado($requestBody['num_empleado']);
        $user->setEstatus(1);
        //$user->setDate(new \DateTime('now'));

        if ($requestBody['role'] == "MOBILE") {
            $roles = ["ROLE_MOBILE"];
            $user->setRoles($roles);
        }elseif ($requestBody['role'] == "WEB") {
            $roles = ["ROLE_WEB"];
            $user->setRoles($roles);
        }elseif ($requestBody['role'] == "MOBILE_WEB") {
            $roles = ["ROLE_MOBILE_WEB"];
            $user->setRoles($roles);
        }
        else{
            return $this->json([
                'error' => self::INVALID_PARAMS
            ]);
        }

        if (isset($requestBody['usuario_creacion'])) {

            $date = new \DateTime('now');
            $dateModify = $date->format('Y-m-d H:i:s');
            $user->setUsuarioCreacion($requestBody['usuario_creacion']);
            $user->setFecCreacion($dateModify);
            

        }

        if (isset($requestBody['usuario_modificacion'])) {
            $date = new \DateTime('now');
            $dateModify = $date->format('Y-m-d H:i:s');
            $user->setUsuarioModificacion($requestBody['usuario_modificacion']);
            $user->setFecModificacion($dateModify);

        }
        
        $encoded = $encoder->encodePassword($user, $requestBody['password']);
        $user->setPassword($encoded);
        $user->setConectado(0);
        
        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->persist($user);
        $entityManager->flush();
        $message = 'SUCCESS';
        
        $repository = $this->getDoctrine()->getRepository(Usuario::class);
        $userSearch = $repository->findOneBy([
            'username' => $requestBody['username']
        ],[
            'fecCreacion' => 'DESC'
        ]);
        
        return $this->json([
            'id'=> $userSearch->getId(),
            'message' => $message
        ]);

    }

    public function login(AuthenticationUtils $autenticationUtils){

        $request = Request::createFromGlobals();
        
        $requestBody = json_decode($request->getContent(), true);

        $repository = $this->getDoctrine()->getRepository(Usuario::class);

        $user = $repository->findOneBy([
            'username' => $requestBody['username']
        ]);

        if (!$user) {
            return $this->json([
                'error' => self::USER_NOT_FOUND
            ]);
        }

        $hashedPassword = $user->getPassword();
        if(!password_verify($requestBody['password'], $hashedPassword)) {
            return $this->json([
                'error' => self::INVALID_PASSWORD
            ]);
        }
        $role = $user->getRoles();
        $userType;
        if ($role[0] == "ROLE_WEB") {
            $tokenData = [
                'data' => [
                  'type' => self::WEB_IDENTIFIER,
                  'username' => $user->getUsername()
                ]//,
                //'exp' => time() + (31 * 24 * 60 * 60)
            ];
            $userType = "web";
        }elseif($role[0] == "ROLE_MOBILE") {
            $tokenData = [
                'data' => [
                  'type' => self::MOBILE_IDENTIFIER,
                  'username' => $user->getUsername()
                ]
            ];
            $userType = "mobile";
        }else if($role[0] == "ROLE_MOBILE_WEB"){
            $tokenData = [
                'data' => [
                  'type' => self::MOBILE_WEB_IDENTIFIER,
                  'username' => $user->getUsername()
                ]
            ];
            $userType = "mobile_web";
        }else{
            return $this->json([
                'error' => "NOT_IDENTIFIER"
            ]);
        }

        if ($user->isEstatus() != 1) {
            return $this->json([
                'error' => "INACTIVE_USER"
            ]);
        }
      
        $tokenString = $this->authService->generateToken($tokenData);
      
        return $this->json([
            'token' => $tokenString,
            'userType' => $userType,
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'num_empleado' => $user->getNumEmpleado(),
            'conected' => $user->getConectado()
        ]);

    }

    public function verify() : Response {

        $user = $this->getUser();

        if (!$user) {
            return $this->json([
                'error' => self::USER_NOT_FOUND
            ]);
        }
        
        $role = $user->getRoles();

        if($role[0] == "ROLE_WEB") {

            $role = "WEB";

        }elseif($role[0] == "ROLE_MOBILE"){

            $role = "MOBILE";
            
        }elseif($role[0] == "ROLE_MOBILE_WEB"){

            $role = "MOBILE_WEB";

        }
        
        $serializer = $this->serializerService->getSerializer();
        return $this->json([
            'message' => "SUCCESS",
            'id' => $user->getId(),
            'role' => $role,
            'username' => $user->getUsername(),
            'status' => $user->isEstatus()
        ]);
    }

    public function update(UserPasswordEncoderInterface $encoder){

        $request = Request::createFromGlobals();

        $decoded = $this->authService->validateRequest($request);
        if (gettype($decoded) == 'array' && isset($decoded['error'])) {
            return $this->json($decoded);
        }
        
        $requestBody = json_decode($request->getContent(), true);

        $repository = $this->getDoctrine()->getRepository(Usuario::class);

        if (!isset($requestBody['id']) ) {

            return $this->json([
                'error' => self::INVALID_PARAMS
            ]);
        }

        $user = $repository->findOneBy([
            'id' => $requestBody['id']
        ]);

        if (!$user) {
            return $this->json([
                'error' => self::USER_NOT_FOUND
            ]);
        }

        
        if (isset($requestBody['username'])) {

            $user->setUsername($requestBody['username']);

        }

        if (isset($requestBody['password']) && $requestBody['password'] != null) {

            $encoded = $encoder->encodePassword($user, $requestBody['password']);
            $user->setPassword($encoded);

        }

        if (isset($requestBody['role'])) {

            if ($requestBody['role'] == "MOBILE") {
                $roles = ["ROLE_MOBILE"];
                $user->setRoles($roles);
            }elseif ($requestBody['role'] == "WEB") {
                $roles = ["ROLE_WEB"];
                $user->setRoles($roles);
            }elseif ($requestBody['role'] == "MOBILE_WEB") {
                $roles = ["ROLE_MOBILE_WEB"];
                $user->setRoles($roles);
            }else{
                return $this->json([
                    'error' => self::INVALID_PARAMS
                ]);
            }

        }
        
        if (isset($requestBody['status'])) {

            $user->setEstatus($requestBody['status']);

        }

        if (isset($requestBody['conected'])) {

            $user->setConectado($requestBody['conected']);

        }

        if (isset($requestBody['usuario_creacion'])) {

            $user->setUsuarioCreacion($requestBody['usuario_creacion']);
            $date = new \DateTime('now');
            $dateModify = $date->format('Y-m-d H:i:s');
            $user->setFecCreacion($dateModify);

        }

        if (isset($requestBody['usuario_modificacion'])) {
            
            $user->setUsuarioModificacion($requestBody['usuario_modificacion']);
            $date = new \DateTime('now');
            $dateModify = $date->format('Y-m-d H:i:s');
            $user->setFecModificacion($dateModify);

        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();
        $message = 'SUCCESS';
        return $this->json([
            'message' => $message
        ]);
 

    }

    public function getAll(): Response{

        $request = Request::createFromGlobals();
    
        $decoded = $this->authService->validateRequest($request);
        if (gettype($decoded) == 'array' && isset($decoded['error'])) {
            return $this->json($decoded);
        }
    
        $repository = $this->getDoctrine()->getRepository(Usuario::class);
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

    public function getTourList($id): Response{

        //$request = Request::createFromGlobals();
    
        /*$decoded = $this->authService->validateRequest($request);
        if (gettype($decoded) == 'array' && isset($decoded['error'])) {
            return $this->json($decoded);
        }*/
    
        $repository = $this->getDoctrine()->getRepository(Usuario::class);
        $user = $repository->findOneBy([
            'id' => $id
        ]);
        
    
        if (!$user) {
          return $this->json([
            'error' => "USER_NOT_FOUND"
          ]);
        }

        $repositoryPerson = $this->getDoctrine()->getRepository(Persona::class);
        $person = $repositoryPerson->findOneBy([
            'numEmpleado' => $user->getNumEmpleado()
        ]);
        
    
        if (!$person) {
          return $this->json([
            'error' => "TRIPULANTE_NOT_FOUND"
          ]);
        }

        $repositoryCrewMember = $this->getDoctrine()->getRepository(Tripulante::class);
        $crewMember = $repositoryCrewMember->findOneBy([
            'fkPersona' => $person,
            'estatusRegistro' => 1
        ],[
            'fecCreacion' => 'DESC'
        ]);
        
    
        if (!$crewMember) {
          return $this->json([
            'error' => "TRIPULANTE_NOT_FOUND"
          ]);
        }

        $connection = $this->getDoctrine()->getConnection();
        $sql = 'SELECT lista_recorrido.ID_LISTA_RECORRIDO AS idLista
        FROM persona 
        LEFT JOIN tripulante
        ON persona.ID_PERSONA = tripulante.FK_PERSONA AND tripulante.FK_ROL = 1
        LEFT JOIN lista_recorrido
        ON lista_recorrido.ID_LISTA_RECORRIDO = tripulante.FK_LISTA_RECORRIDO
        WHERE lista_recorrido.FEC_LISTA = CONVERT(DATE, CURRENT_TIMESTAMP) AND lista_recorrido.FK_ESTATUS = 19 AND persona.NUM_EMPLEADO ='.$user->getNumEmpleado().'
        ORDER BY lista_recorrido.ID_LISTA_RECORRIDO DESC;';
        $prepare = $connection->query($sql);
        $resultSet = $prepare->fetchAll();
    
        if (!$resultSet) {
            return $this->json([
                'error' => "NOT_FOUND"
            ]);
        }

        $repository = $this->getDoctrine()->getRepository(ListaRecorrido::class);
        $tourList = $repository->findOneBy([
            'idListaRecorrido' => $resultSet[0]['idLista']
        ]);
        
    
        if (!$tourList) {
          return $this->json([
            'message' => "TOURLIST_NOT_FOUND"
          ]);
        }
        $crewMember->setFkListaRecorrido($tourList);
        $serializer = $this->serializerService->getSerializer();
        $data = $serializer->serialize($crewMember, 'json');
    
        return new Response($data);
    }

    public function getTourListEntry($id): Response{

        $request = Request::createFromGlobals();
    
        $decoded = $this->authService->validateRequest($request);
        if (gettype($decoded) == 'array' && isset($decoded['error'])) {
            return $this->json($decoded);
        }
    
        $repository = $this->getDoctrine()->getRepository(Usuario::class);
        $user = $repository->findOneBy([
            'id' => $id
        ]);
        
    
        if (!$user) {
          return $this->json([
            'error' => "USER_NOT_FOUND"
          ]);
        }

        $repositoryPerson = $this->getDoctrine()->getRepository(Persona::class);
        $person = $repositoryPerson->findOneBy([
            'numEmpleado' => $user->getNumEmpleado()
        ]);
        
    
        if (!$person) {
          return $this->json([
            'error' => "TRIPULANTE_NOT_FOUND"
          ]);
        }

        $repositoryCrewMember = $this->getDoctrine()->getRepository(Tripulante::class);
        $crewMember = $repositoryCrewMember->findOneBy([
            'fkPersona' => $person,
            'estatusRegistro' => 1
        ],[
            'fecCreacion' => 'DESC'
        ]);
        
    
        if (!$crewMember) {
          return $this->json([
            'error' => "TRIPULANTE_NOT_FOUND"
          ]);
        }

        $connection = $this->getDoctrine()->getConnection();
        $sql = 'SELECT lista_recorrido.ID_LISTA_RECORRIDO AS idLista
        FROM persona 
        LEFT JOIN tripulante
        ON persona.ID_PERSONA = tripulante.FK_PERSONA AND tripulante.FK_ROL = 1
        LEFT JOIN lista_recorrido
        ON lista_recorrido.ID_LISTA_RECORRIDO = tripulante.FK_LISTA_RECORRIDO
        WHERE lista_recorrido.FEC_LISTA = CONVERT(DATE, CURRENT_TIMESTAMP) AND persona.NUM_EMPLEADO ='.$user->getNumEmpleado().'
        ORDER BY lista_recorrido.ID_LISTA_RECORRIDO DESC;';
        $prepare = $connection->query($sql);
        $resultSet = $prepare->fetchAll();
    
        if (!$resultSet) {
            return $this->json([
                'error' => "NOT_FOUND"
            ]);
        }

        $repository = $this->getDoctrine()->getRepository(ListaRecorrido::class);
        $tourList = $repository->findOneBy([
            'idListaRecorrido' => $resultSet[0]['idLista']
        ]);
        
    
        if (!$tourList) {
          return $this->json([
            'message' => "TOURLIST_NOT_FOUND"
          ]);
        }
        $crewMember->setFkListaRecorrido($tourList);
        $serializer = $this->serializerService->getSerializer();
        $data = $serializer->serialize($crewMember, 'json');
    
        return new Response($data);
    }

    public function getMembership($id): Response{

        $request = Request::createFromGlobals();
    
        $decoded = $this->authService->validateRequest($request);
        if (gettype($decoded) == 'array' && isset($decoded['error'])) {
            return $this->json($decoded);
        }
    
        $repository = $this->getDoctrine()->getRepository(Membresia::class);
        $membership = $repository->findBy([
            'fkUsuario' => $id,
            'fkFuncion' => 6
        ]);
        
    
        if (!$membership) {
          return $this->json([
            'message' => "MEMBERSHIP_NOT_FOUND"
          ]);
        }

        $serializer = $this->serializerService->getSerializer();
        $data = $serializer->serialize($membership, 'json');
    
        return new Response($data);
    }

}
