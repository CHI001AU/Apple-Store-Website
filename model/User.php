<?php
// Model/User.php

class User {
    private ?int $userId;
    private ?string $username;
    private ?string $password;
    private ?string $firstName;
    private ?string $lastName;
    private ?string $street;
    private ?string $town;
    private ?string $state;
    private ?string $postcode;
    private ?string $phone;
    private ?string $email;
   

public function __construct(
    ?int $userId=null,
    ?string $username=null,
    ?string $password=null,
    ?string $firstName=null,
    ?string $lastName=null,
    ?string $street=null,
    ?string $town=null,
    ?string $state=null,
    ?string $postcode=null,
    ?string $phone=null,
    ?string $email=null
) {
    $this->userId = $userId;
    $this->username = $username;
    $this->password = $password;
    $this->firstName = $firstName;
    $this->lastName = $lastName;
    $this->street = $street;
    $this->town = $town;
    $this->state = $state;
    $this->postcode = $postcode;
    $this->phone = $phone;
    $this->email = $email;
}

    //getters
    public function getUserId(): int {
        return $this->userId;
    }

    public function getUserName(): string {
        return ucwords(strtolower($this->username));
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function getfirstName(): ?string {
        return $this->firstName;
    }

    public function getlastName(): ?string {
        return $this->lastName;
    }

    public function getStreet() { 
        return $this->street; 
    }
    public function getTown() { 
        return $this->town; 
    }
    public function getState() { 
        return $this->state;
    }
    public function getPostcode() { 
        return $this->postcode; 
    }
    public function getPhone() { 
        return $this->phone; 
    }
    public function getEmail() { 
        return $this->email; 
    }



    //setters
    public function setUserId(?int $userId): void {
        $this->userId = $userId;
    }

    public function setUsername(string $username): void {
        $this->username = $username;
    }

    public function setPassword(string $password): void {
        $this->password = $password;
    }

    public function setFirstName(string $firstName): void {
        $this->firstName = $firstName;
    }

    public function setLastName(string $lastName): void {
        $this->lastName = $lastName;
    }

    public function setStreet($v) { 
        $this->street = $v; 
    }

    public function setTown($v) { 
        $this->town = $v; 
    }

    public function setState($v) { 
        $this->state = $v; 
    }

    public function setPostcode($v) { 
        $this->postcode = $v; 
    }

    public function setPhone($v) { 
        $this->phone = $v; 
    }
    
    public function setEmail($v) { 
        $this->email = $v; 
    }
    
    
}