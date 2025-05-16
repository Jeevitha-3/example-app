<?php

namespace App\DTO;

class RegisterDTO
{
    public string $name;
    public string $email;
    public string $phonenumber;
    public string $address;
    public string $city;
    public string $state;
    public string $country;
    public string $zipcode;
    public int $role;
    public string $gender;
    public string $dob;

    public function __construct(array $data)
    {
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->phonenumber = $data['phonenumber'];
        $this->address = $data['address'];
        $this->city = $data['city'];
        $this->state = $data['state'];
        $this->country = $data['country'];
        $this->zipcode = $data['zipcode'];
        $this->role = (int) $data['role'];
        $this->gender = $data['gender'];
        $this->dob = $data['dob'];
    }
}   