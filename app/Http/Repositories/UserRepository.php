<?php

namespace App\Http\Repositories;

use App\Models\User;

class UserRepository implements IRepositoryfirst
{
    protected $model;
    public function  __construct(User $model)
    {
        $this->model = $model;
    }
    public function findOrCreate(array $data)
    {
        return   $this->model->firstOrCreate(
            ['cni'=>$data['cni']],
            [

            'prenom' => $data['prenom'],
            'nom' => $data['nom'],
            'adresse' => $data['adresse'],
            'telephone' => $data['telephone'],
            'statut' => 'actif',
            "email"=>$data["email"],
            // 'login' => $data['email']
            // 'cni'=>$data['cni'], ********


        ]);
    }
}

