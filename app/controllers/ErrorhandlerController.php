<?php



class ErrorhandlerController extends ControllerBase
{
    public function notFound(){
        $this->jsonResponse(['message' => 'the requested resource was not found'], 404, 'Not Found');
    }

    public function notAuthenticated(){
        $this->jsonResponse(['message' => 'Not Autheticated in the Api, not access to the resources'], 401, 'Not Authorized');
    }
}