<?php

namespace App\Http\Services;

use App\Events\CompteCreated;
use Illuminate\Support\Str;

use App\Http\Repositories\IRepository;
use App\Http\Resources\CompteResource;
use App\Models\Compte;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        $isClientNew = false;

        $user = $this->userService->create($data['client']);
        Log::info("message", [
         'telephone'=> $user->telephone]);
        if ($user->wasRecentlyCreated) {
          $isClientNew = true;
        }
        $client = $this->clientService->create(['user_id' => $user->id]);

        $compte = $this->repositoryCompte->create([
          'client_id' => $client->id,

          'type' => $data['type'],
          'statut' => "actif"
        ]);
        event(new \App\Events\CompteCreated($compte, $user, $isClientNew));
        return $compte;
      });
    } catch (\Exception $e) {
      // Log ou renvoyer une erreur
      throw new \Exception("Erreur lors de la création du compte : " . $e->getMessage());
    }
  }
}
