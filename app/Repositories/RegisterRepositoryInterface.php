<?php
namespace App\Repositories;

interface RegisterRepositoryInterface
{
    public function repoStore(array $data);

    public function repoUpdate($id, array $data);

    public function repoDelete($id);

    public function repoFind($id);
    
    public function repoCreate(array $data);

}

