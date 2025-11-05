<?php
namespace App\Http\Services;

use App\Http\Repositories\IRepository;
use App\Http\Resources\CompteResource;
use Illuminate\Database\Eloquent\Collection;

class CompteService {
    protected IRepository $repositoryCompte;

    public function __construct( IRepository $repositoryCompte)
    {
      $this->repositoryCompte=$repositoryCompte;
    }
 public function  getAll($filters,$order,$sort ,$limit){

  return  $this->repositoryCompte->getAll($filters,$order,$sort ,$limit);
         
 }

}