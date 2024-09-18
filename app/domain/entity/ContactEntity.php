<?php

namespace app\domain\entity;

class ContactEntity extends BaseEntity {

    private $id;
    private string $nick;
    private string $name;
    private string $firstName;
    private string $email;
    private string $phone;

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function getFirstName(): string {
        return $this->firstName ?? '';
    }

    public function setFirstName(string $firstName): void {
        $this->firstName = $firstName;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function getPhone(): string {
        return $this->phone;
    }

    public function setPhone(string $phone): void {
        $this->phone = $phone;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function getNick(): string {
        $initials = '';
        $words = explode(' ', trim($this->getName(), $this -> getFirstName()));
        $numWords = count($words);

        if ($numWords > 1) {
            $initials = strtoupper($words[0][0] . $words[1][0]);
        } else {
            // Si tiene una sola palabra
            $firstWord = $words[0];
            $wordLength = strlen($firstWord);

            // Si la palabra tiene más de una letra, tomamos las dos primeras letras
            if ($wordLength >= 2) {
                $initials = strtoupper(substr($firstWord, 0, 2));
            } else {
                // Si la palabra tiene solo una letra, repetirla dos veces
                $initials = strtoupper($firstWord[0] . $firstWord[0]);
            }
        }

        return $initials;
    }

    public function toString(): string {
        return json_encode([
            'id' => $this->getId(),
            'name' => $this->getName(),
            'first_name' => $this->getFirstName(),
            'phone' => $this->getPhone(),
            'email' => $this->getEmail()
        ]);
    }

}