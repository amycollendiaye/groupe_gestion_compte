<?php

namespace App\Http\Services;

use App\Http\Repositories\IRepositoryfirst;
use App\Models\User;

class ClientService
{
    protected $repoClient;
    public function __construct(IRepositoryfirst $repoClient)
    {
        $this->repoClient = $repoClient;
    }
    public function  create(array $data)
    {


        return     $this->repoClient->findOrCreate($data);
    }
}
