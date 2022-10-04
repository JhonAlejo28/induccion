<?php

use Nowakowskir\JWT\JWT;
use Nowakowskir\JWT\TokenDecoded;

class LoginController extends ControllerBase
{

    public function login()
    {
        $request = $this->request;
        if($request->isPost()){
            $username = $request->getPost('username');
            $password = $request->getPost('password');
            if($username == 'jhon' && $password == '123456'){
                $privateKey = file_get_contents(APP_PATH . '/libraries/private.key');
                $payload = [
                    'username' => $username,
                    'name' => 'Jhon Hernandez',
                    'rol' => 'Admin',
                    'iat' => time(),
                    'exp' => time()+10*6

                ];
                $tokenDecoded = new tokenDecoded($payload);
                $tokenEncoded = $tokenDecoded->encode($privateKey, JWT::ALGORITHM_RS256);
                $this->jsonResponse(['token'=>$tokenEncoded->toString()]);
                
            }else{
                $this->jsonResponse(['message' => 'User or password invalid'], 401, 'Unauthorized');
            }
        }

    }

}