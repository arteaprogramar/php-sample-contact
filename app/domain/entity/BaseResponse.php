<?php

namespace app\domain\entity;

class BaseResponse {

    public string $message;
    public mixed $data;

    public function __construct(string $message, mixed $data) {
        $this -> message = $message;
        $this -> data = $data;
    }

}