<?php

namespace App\Http\Services;

use App\Http\Repositories\IRepository;
use App\Http\Resources\CompteResource;
use App\Models\Compte;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class CompteService
{
  protected IRepository $repositoryCompte;
  protected ClientService $clientService;
  protected UserService $userService;


  public function __construct(IRepository $repositoryCompte, UserService $userService, ClientService $clientService)
  {
    $this->repositoryCompte = $repositoryCompte;
    $this->clientService = $clientService;
    $this->userService = $userService;
  }
  public function  getAll($filters, $order, $sort, $limit)
  {

    return  $this->repositoryCompte->getAll($filters, $order, $sort, $limit);
  }
  public  function create(array $data)
  {
    try {
      return DB::transaction(function () use ($data) {
        $user = $this->userService->create($data['client']);
        //  var_dump($user);
        $client = $this->clientService->create(['user_id' => $user->id]);

        return $this->repositoryCompte->create([
          'client_id' => $client->id,
          
          'type' => $data['type'],
          'statut' => "actif"
        ]);
      });
    } catch (\Exception $e) {
      // Log ou renvoyer une erreur
      throw new \Exception("Erreur lors de la création du compte : " . $e->getMessage());
    }
  }
}
