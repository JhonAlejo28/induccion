<?php

abstract class ControllerBase extends Phalcon\Mvc\Controller
{
    protected function jsonResponse($data, $statusCode = 200, $statusText = "Ok"){
        $response = $this->response;
        $this->response->setHeader('Access-Control-Allow-Origin', '*');
        $this->response->setHeader('Access-Control-Allow-Methods', 'GET,PUT,POST,DELETE,OPTIONS');
        $this->response->setHeader("Access-Control-Allow-Headers", "Authorization, Content-Type, X-Requested-With ");
        $response->setStatusCode($statusCode, $statusText);
        $returnData = [
            'data' => $data
        ];
        $response->setJsonContent($returnData);
        // $response->setJsonContent($data);
        $response->send();
    }

    protected function returnErrorsModel($model){
        $errors = [];
        foreach($model->getMessages() as $error){
            $errors[] = [
                'message' => $error->getMessage(),
                'field' => $error->getField()
            ];
        }
        $this->jsonResponse($errors, 400, 'Bad request');
    }

    protected function responseCORS(){
        $this->response->setHeader('Access-Control-Allow-Origin', '*');
        $this->response->setHeader('Access-Control-Allow-Methods', 'GET,PUT,POST,DELETE,OPTIONS');
        $this->response->setHeader("Access-Control-Allow-Headers", "Authorization, Content-Type, X-Requested-With ");
        $this->response->setStatusCode(200, 'OK')->sendHeaders()->send();
        die();
    }
}