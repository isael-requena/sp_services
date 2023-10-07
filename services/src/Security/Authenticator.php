<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;

use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Usuario;

use App\Service\AuthService;

use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\SignatureInvalidException;

class Authenticator extends AbstractGuardAuthenticator
{
    private const EXPIRED_TOKEN_ERROR = 'EXPIRED_TOKEN';
    private const INVALID_TOKEN_ERROR = 'INVALID_TOKEN';
    private const SEGMENT_TOKEN_ERROR = 'SEGMENT_TOKEN';
    private const AUTH_MISSING_ERROR = 'AUTH_MISSING';
    private const USER_TYPE_NOT_RECOGNIZED_ERROR = 'USER_TYPE_NOT_RECOGNIZED';

    private $authService;
    private $entityManager;
    
    public function __construct(AuthService $authService, EntityManagerInterface $entityManager) { 
        $this->authService = $authService;
        $this->entityManager = $entityManager;
    }

    public function supports(Request $request)
    {
        return $request->headers->has('authorization') && 
            strpos($request->headers->get('authorization'), 'USER_FALSE') === false;
    }

    public function getCredentials(Request $request)
    {
        return $request->headers->get('authorization');
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        if ($credentials === null) {
            return null;
        }

        $decoded = null;
        $user = null;

        try { 
            $decoded = $this->authService->validateAuth($credentials);
        } catch(ExpiredException $error) { 
            throw new CustomUserMessageAuthenticationException(self::EXPIRED_TOKEN_ERROR);
        } catch(SignatureInvalidException $error) {
            throw new CustomUserMessageAuthenticationException(self::INVALID_TOKEN_ERROR);
        } catch(\UnexpectedValueException $error) { 
            throw new CustomUserMessageAuthenticationException(self::SEGMENT_TOKEN_ERROR);
        }
        
        if ($decoded->data->type != 'MOBILE' && $decoded->data->type != 'WEB' && $decoded->data->type != 'MOBILE_WEB') { 
            throw new CustomUserMessageAuthenticationException(self::USER_TYPE_NOT_RECOGNIZED_ERROR);   
        }
    
        try { 
            $user = $userProvider->loadUserByUsername($decoded->data->username);
        } catch(\Exception $error) { 
            throw new CustomUserMessageAuthenticationException($error->getMessage());
        }

        return $user;
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        return true;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $data = [
            'error' => strtr($exception->getMessageKey(), $exception->getMessageData())
        ];

        return new JsonResponse($data, Response::HTTP_UNAUTHORIZED);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $providerKey)
    {
        return null;
    }

    public function start(Request $request, AuthenticationException $authException = null)
    {
        $data = [
            'error' => self::AUTH_MISSING_ERROR
        ];

        return new JsonResponse($data, Response::HTTP_UNAUTHORIZED);    
    }

    public function supportsRememberMe()
    {
        return false;
    }
}
