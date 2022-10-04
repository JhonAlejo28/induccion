<?php



class Pruebacontroller extends ControllerBase
{
    public function index()
    {
        $message =  'Hola desde el controlador de prueba';
        $this-> jsonResponse(['message' => $message ]);
    }
}