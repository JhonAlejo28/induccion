<?php

class DogsController extends ControllerBase
{

    public function get(){
        try {
            $dogs = Dogs::find()->toArray();
            $this->jsonResponse($dogs);
        } catch (Exception $e) {
            $error = ["message"=> "Ups, error ocurred"];
            $this->jsonResponse($error, 400, 'Bad Request');
        }
    }




     public function getDog($id)
    {
        echo 'Este es el id'. $id;
        try {
            $dog = Dogs::find($id)->toArray();
            $this->jsonResponse($dog);
        } catch (Exception $e) {
            $error = ["message"=> "Ups, error ocurred"];
            $this->jsonResponse($error, 400, 'Bad Request');
        }
    } 

    public function getDogName($name)
    {
        try {
            $dog = Dogs::find('name =' . $name)->toArray();
            $this->jsonResponse($dog);
        } catch (Exception $e) {
            $error = ["message"=> "Ups, error ocurred"];
            $this->jsonResponse($error, 400, 'Bad Request');
        }
    } 

    

    public function createDogs() {
        $request = $this->request;
        if ($request->isPost()){
          $dog = new Dogs();
          $dog->name = $request->getPost('name' ,['upper', 'trim']); 
          $dog->breed = $request->getPost('breed', ['upper', 'trim']);
          $dog->age = $request->getPost('age');
          $dog->weight = $request->getPost('weight');
          if($dog->create()){
            $this->jsonResponse([$dog->toArray()]);
          } else {
            $this->returnErrorsModel($dog);
          }
        }
    }

    public function update($id){
        $request = $this->request;
        if($request->isPut()){
          $dog = dogss::findFirst($id);
          $dog->name = $request->getPost('name' ,['upper', 'trim']); 
          $dog->breed = $request->getPost('breed', ['upper', 'trim']);
          $dog->age = $request->getPost('age');
          $dog->weight = $request->getPost('weight');
          if ($dog->update()){
            $this->jsonResponse([$dog->toArray()]);
          } else {
            $this->returnErrorsModel($dog);
          }
        }
    }
    

    public function delete($id){
        $request = $this->request;
        if ($request->isDelete()) {
          $dog = Dogs::findFirst($id);
          if(isset($dog->id)){
            if($dog->delete()){
                $this->jsonResponse(['message' => 'The dogs ' . $dog->dog . ' has eliminated']);
            }else{
                $this->returnErrorsModel($dog);
            }
        }else{
            $this->jsonResponse(['message' => 'It dog no exist'], 400, 'Bad Request');
        }
      }    
    }


}