<?php

use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Mvc\Model\Message;
use Phalcon\Validation\Validator\Numericality;

class Dogs extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var string
     */
    public $breed;

    /**
     *
     * @var integer
     */
    public $age;

    /**
     *
     * @var double
     */
    public $weight;


    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("bd_prueba");
        $this->setSource("dogs");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'dogs';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Users[]|Users|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Users|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    public function validation(){

        $validator = new Validation();

        $validator->add(['name', 'breed'],new PresenceOf(
                [
                    'message' => 
                    [
                        'name' => 'El nombre no puede estar vacio',
                        'breed' => 'La raza no puede estar vacia'    

                ]
                ]
            )
        );

        $validator->add(['weight', 'age'], new Numericality([
            'message' => [
                'weight' => 'The weight of the dog must be a number',
                'age' => 'The age of the dog must be a number'
            ]
        ])
        );

        return $this->validate($validator);
   
    }

    public function beforeSave(){
        $this->name = strtoupper($this->name);
        $this->breed = strtoupper($this->breed);
    }


}