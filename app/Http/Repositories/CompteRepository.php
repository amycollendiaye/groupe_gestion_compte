<?php
namespace App\Http\Repositories;

use App\Http\Resources\CollectionRessource;
use App\Models\Compte;
use App\Models\Scopes\WithActif;

class CompteRepository  implements IRepository{

    public function getAll($filters=[], $order="desc", $sort="created_at",$limit=10)
    {
        
         $query=Compte::query();



          if(!empty($filters['type_compte'])){
                $query->where('type_compte', $filters["type_compte"]);

          }
           if(!empty($filters['statut'])){
            $query->withoutGlobalScope(WithActif::class);
                $query->where('statut', $filters["statut"]);

          }
          if(!empty($filters["search"])){
                    $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('numero_compte', 'like', "%$search%")
                  ->orWhereHas('client.user', function ($q2) use ($search) {
                      $q2->where('prenom', 'like', "%$search%")
                         ->orWhere('nom', 'like', "%$search%");
                  });
            });


          }
    return $query->orderBy($sort, $order)->paginate($limit);
       }
}