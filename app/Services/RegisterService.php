<?php

namespace App\Services;

use App\DTO\RegisterDTO;
use App\Models\Register;

class RegisterService
{
    public function store(RegisterDTO $dto): Register
    {
        return Register::create([
            'name' => $dto->name,
            'email' => $dto->email,
            'phonenumber' => $dto->phonenumber,
            'address' => $dto->address,
            'city' => $dto->city,
            'state' => $dto->state,
            'country' => $dto->country,
            'zipcode' => $dto->zipcode,
            'role' => $dto->role,
            'gender' => $dto->gender,
            'dob' => $dto->dob,
        ]);
    }
}
