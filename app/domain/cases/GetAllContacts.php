<?php

namespace app\domain\cases;

use app\domain\BaseCase;
use app\domain\entity\ContactEntity;
use app\infrastructure\repository\ContactRepository;

class GetAllContacts extends BaseCase {

    private ContactRepository $model;

    public function __construct(){
        $this -> model = new ContactRepository();
    }

   protected function transform(): array{
        return $this -> getAttributes();
   }

    public function execute() : GetAllContacts {
        $customData = [];

        foreach ($this -> model -> getAll() as $index => $value) {
            $response = new ContactEntity();

            $response -> setId($value['id']);
            $response -> setName($value['name']);
            $response -> setFirstName($value['first_name']);
            $response -> setPhone($value['phone']);
            $response -> setEmail($value['email']);
            $response -> setActive($value['active']);
            $response -> setCreatedAt($value['created_at']);
            $response -> setCreatedBy($value['created_by']);
            //$response -> setUpdatedAt($value['updated_at']);
            //$response -> setUpdatedBy($value['updated_by']);

            $customData[$index] = $response;
        }

        $this -> setData($customData);
        return $this;
    }

}