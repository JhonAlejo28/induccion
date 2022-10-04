<?php

use Nowakowskir\JWT\JWT;
use Nowakowskir\JWT\TokenDecoded;
use Nowakowskir\JWT\TokenEncoded;

class AclController extends ControllerBase
{

    private $_uri;
    private $_method;
    private $_uriAllowed;

    public function init(){
        $this->setParameters();
        if($this->_method === 'OPTIONS'){
            $this->responseCORS();
        }
        if(!$this->checkIsPublicEndpoint()){
            if(!$this->checkIsValidToken()){
                die();
            };
            
        }
        /*
        Verificar si la Endpoint o ruta requiere autenticacion
        Verificar si se envía token
        Verificar que el token es valido
        */
    }      
                    
    private function setParameters(){
        $this->_uri = $this->router->getRewriteUri();
        $this->_method = $this->request->getMethod(); 
        $this->_uriAllowed = [ 
            [
                'uri' => '/proteins',
                'method' => 'GET'
            ],
            [
                'uri' => '/login',
                'method' => 'POST'
            ],

            ];
    }
            
    private function checkIsPublicEndpoint(){
        foreach($this->_uriAllowed as $uriAllowed){
            if($uriAllowed['uri'] === $this->_uri && $uriAllowed['method'] === $this->_method){
                return true;
            }
        }
        return false;
    }

    private function checkIsValidToken(){
        $headers = apache_request_headers();
        $token = isset($headers['Authorization']) ? $headers['Authorization'] : $this->request->getQuery("token");
        if(isset($token)){
            $token = explode("Bearer", $token);
            $token = isset($token[1]) ? $token[1] : null;
            if(isset($token)){
                try {
                    $tokenEncoded = new TokenEncoded(trim($token));
                    $publicKey = file_get_contents(APP_PATH . '/libraries/public.pub');
                    $tokenEncoded->validate($publicKey, JWT::ALGORITHM_RS256);
                    return true;
                }catch(Nowakowskir\JWT\Exceptions\TokenExpiredException $e){
                    $this->jsonResponse(['message'=>'Your Token Expired'], 401, 'Unauthorized');
                    die();
                } 
                catch(Exception $e){
                    $this->jsonResponse(['message' => $e->getMessage()], 401, 'Unauthorized');
                    die();
            }
            
            }else{
                $this->jsonResponse(['message' => 'No Valid'], 401, 'Unauthorized');
        }
        }else{
            $this->jsonResponse(['message' => 'No Valid'], 401, 'Unauthorized');
    
    }

}

}