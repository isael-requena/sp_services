<?php
namespace App\Service;

use \Firebase\JWT\JWT;
use \Firebase\JWT\ExpiredException;

class AuthService {
  private const WEB_JWT_PASSWORD = '7698_WEB_JWT_PASSWORD_9876';
  private const MOBILE_JWT_PASSWORD = '4321_MOBILE_JWT_PASSWORD_1234';
  private const MOBILE_WEB_JWT_PASSWORD = '3412_MOBILE_WEB_JWT_PASSWORD_2143';

  const WEB_IDENTIFIER = 'ADMIN';
  const MOBILE_IDENTIFIER = 'MOBILE';
  const MOBILE_WEB_IDENTIFIER = 'MOBILE_WEB';

  const TOKEN_EXPIRED_ERROR = 'EXPIRED_TOKEN';

  const INVALID_USER_ERROR = 'INVALID_USER';
  const AUTH_MISSING_ERROR = 'AUTH_MISSING';

  public function generateToken($tokenData) {
    $key;
    if($tokenData['data']['type'] == self::WEB_IDENTIFIER) {

      $key = self::WEB_JWT_PASSWORD;

    }elseif($tokenData['data']['type'] == self::MOBILE_IDENTIFIER){

      $key = self::MOBILE_JWT_PASSWORD;

    }else{

      $key = self::MOBILE_WEB_JWT_PASSWORD;

    }

    $tokenString = JWT::encode($tokenData, $key);

    return "{$tokenData['data']['type']} {$tokenString}";
  }

  public function verifyToken($tokenString, $userType, $requirement = NULL) {
    if (isset($requirement) && !in_array($userType, $requirement)) {
      return [
        'error' => self::INVALID_USER_ERROR
      ];
    }
    $key;
    if ($userType == self::WEB_IDENTIFIER) {
      $key = self::WEB_JWT_PASSWORD;
    }elseif ($userType == self::MOBILE_IDENTIFIER) {
      $key = self::MOBILE_JWT_PASSWORD;
    }else{
      $key = self::MOBILE_WEB_JWT_PASSWORD;
    }
    $decoded;
    try {
      $decoded = JWT::decode($tokenString, $key, ['HS256']);
      if (isset($requirement) && !in_array($decoded->data->type, $requirement)) {
        return [
          'error' => self::INVALID_USER_ERROR
        ];
      }
    } catch(ExpiredException $error) { 
      throw $error;
    } catch(SignatureInvalidException $error) {
      throw $error;
    } catch(\UnexpectedValueException $error) { 
      throw $error;
    }

    return $decoded;
  }

  public function validateAuth($authorization, $requirement = NULL) {
    $authData = explode(" ", $authorization, 2);

    return $this->verifyToken($authData[1], $authData[0], $requirement);
  }

  public function validateRequest($request, $requirement = NULL) {
    $requestHeaders = $request->headers;
    $authorization = $requestHeaders->get('Authorization');

    if (!isset($authorization)) {
      return [
        'error' => self::AUTH_MISSING_ERROR
      ];
    }

    return $this->validateAuth($authorization, $requirement);
  }
}
