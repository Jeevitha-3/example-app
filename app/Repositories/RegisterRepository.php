<?php
namespace App\Repositories;

use App\Models\Register;

class RegisterRepository implements RegisterRepositoryInterface
{
    public function repoStore(array $data)
    {
        return Register::create($data);
    }

    public function repoUpdate($id, array $data)
    {
        $register = Register::findOrFail($id);
        $register->update($data);
        return $register;
    }

    public function repoDelete($id)
    {
        $register = Register::findOrFail($id);
        return $register->delete();
    }

    public function repoFind($id)
    {
        return Register::findOrFail($id);
    }

    public function repoCreate(array $data)
    {
        return Register::create($data);
    }
}
