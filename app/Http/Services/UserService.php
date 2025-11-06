<?php

namespace App\Http\Services;

use App\Http\Repositories\IRepositoryfirst;

class UserService
{
    protected  $userRepo;
    public function __construct(IRepositoryfirst $userRepo)
    {
        $this->userRepo = $userRepo;
    }
    public function  create(array $data)
    {
        return $this->userRepo->findOrCreate($data);
    }
}
