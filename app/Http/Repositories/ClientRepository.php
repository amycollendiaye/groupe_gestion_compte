<?php

namespace App\Http\Repositories;

use App\Models\Client;

class ClientRepository implements IRepositoryfirst
{
    protected $model;
    public function __construct(Client $model)
    {
        $this->model = $model;
    }
    public function findOrCreate(array $data)
    {
        return  $this->model->firstOrCreate(
            ['user_id' => $data['user_id']],

            [
                "user_id" => $data['user_id']
            ]
        );
    }
}

