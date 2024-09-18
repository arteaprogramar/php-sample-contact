<?php

namespace app\infrastructure\repository;

use app\infrastructure\BaseModel;

class ContactRepository extends BaseModel {

    public function __construct(){
        parent::__construct();
    }

    public function getAll() : array {
        return $this -> query("SELECT * FROM sample_contact.contact ORDER BY name");
    }

    public function update(array $params) : bool {
        try {
            return $this -> query("UPDATE sample_contact.contact SET phone = :p, name = :n, first_name = :f, email = :e WHERE id = :i", $params);
        } catch (\Exception $exception) {
            return false;
        }
    }

    public function create(array $params) : bool {
        try {
            return $this -> query("INSERT INTO sample_contact.contact(phone, name, first_name, email) VALUES(:p, :n, :f, :e)", $params);
        } catch (\Exception $exception) {
            return false;
        }
    }

}