<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCompte;
use App\Http\Resources\CompteResource;
use App\Http\Services\CompteService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

/**
 * @OA\Info(
 *     title="API de Gestion des Comptes",
 *     version="1.0.0",
 *     description="API pour la gestion des comptes bancaires"
 * )
 */

class CompteController extends Controller
{
     use ApiResponse;

     protected CompteService $compteService;

     public  function __construct(CompteService $compteService)
     {
          $this->compteService = $compteService;
     }

     /**
      * @OA\Get(
      *     path="/api/comptes",
      *     summary="Lister les comptes",
      *     description="Récupère la liste paginée des comptes avec possibilité de filtrage",
      *     operationId="getComptes",
      *     tags={"Comptes"},
      *     @OA\Parameter(
      *         name="type_compte",
      *         in="query",
      *         description="Type de compte à filtrer",
      *         required=false,
      *         @OA\Schema(type="string")
      *     ),
      *     @OA\Parameter(
      *         name="statut",
      *         in="query",
      *         description="Statut du compte à filtrer",
      *         required=false,
      *         @OA\Schema(type="string")
      *     ),
      *     @OA\Parameter(
      *         name="search",
      *         in="query",
      *         description="Recherche par numéro de compte, prénom ou nom",
      *         required=false,
      *         @OA\Schema(type="string")
      *     ),
      *     @OA\Parameter(
      *         name="telephone",
      *         in="query",
      *         description="Filtrer par numéro de téléphone du client",
      *         required=false,
      *         @OA\Schema(type="string")
      *     ),
      *     @OA\Parameter(
      *         name="limit",
      *         in="query",
      *         description="Nombre d'éléments par page",
      *         required=false,
      *         @OA\Schema(type="integer", default=10)
      *     ),
      *     @OA\Parameter(
      *         name="order",
      *         in="query",
      *         description="Ordre de tri (asc/desc)",
      *         required=false,
      *         @OA\Schema(type="string", default="desc")
      *     ),
      *     @OA\Parameter(
      *         name="sort",
      *         in="query",
      *         description="Champ de tri",
      *         required=false,
      *         @OA\Schema(type="string", default="created_at")
      *     ),
      *     @OA\Response(
      *         response=200,
      *         description="Liste des comptes récupérée avec succès",
      *         @OA\JsonContent(
      *             @OA\Property(property="success", type="boolean", example=true),
      *             @OA\Property(property="message", type="string", example="voici la listes des comptes paginess"),
      *             @OA\Property(property="data", type="object")
      *         )
      *     ),
      *     @OA\Response(
      *         response=500,
      *         description="Erreur serveur",
      *         @OA\JsonContent(
      *             @OA\Property(property="success", type="boolean", example=false),
      *             @OA\Property(property="message", type="string"),
      *             @OA\Property(property="errors", type="object")
      *         )
      *     )
      * )
      */
     public function index(Request $request)
     {
          try {

               $filters = $request->only(["type_compte", "statut", "search", "telephone"]);
               $limit = $request->input('limit', 10);
               $order = $request->input('order', "desc");
               $sort = $request->input('sort', "created_at");
               $comptes =  $this->compteService->getAll($filters, $order, $sort, $limit,);
               $compteCollecttion = CompteResource::collection($comptes)->response()->getData(true);
               return $this->paginatedResponse($compteCollecttion, "voici la listes  des comptes paginess");
          } catch (\Throwable $th) {
               return    $this->errorResponse($th->getMessage(), 500);
          }
     }
     
     /**
      * @OA\Post(
      *     path="/api/comptes",
      *     summary="Créer un nouveau compte",
      *     description="Crée un nouveau compte bancaire pour un client",
      *     operationId="createCompte",
      *     tags={"Comptes"},
      *     @OA\RequestBody(
      *         required=true,
      *         @OA\JsonContent(
      *             required={"type", "client"},
      *             @OA\Property(property="type", type="string", example="courant", description="Type de compte"),
      *             @OA\Property(
      *                 property="client",
      *                 type="object",
      *                 description="Informations du client",
      *                 @OA\Property(property="nom", type="string", example="Dupont"),
      *                 @OA\Property(property="prenom", type="string", example="Jean"),
      *                 @OA\Property(property="cni", type="string", example="123456789"),
      *                 @OA\Property(property="telephone", type="string", example="772525225"),
      *                 @OA\Property(property="adresse", type="string", example="Dakar, Sénégal"),
      *                 @OA\Property(property="email", type="string", format="email", example="jean.dupont@example.com"),
      *                 @OA\Property(property="login", type="string", example="jean_dupont")
      *             )
      *         )
      *     ),
      *     @OA\Response(
      *         response=200,
      *         description="Compte créé avec succès",
      *         @OA\JsonContent(
      *             @OA\Property(property="success", type="boolean", example=true),
      *             @OA\Property(property="message", type="string", example="compte creer avec succes"),
      *             @OA\Property(property="data", type="object")
      *         )
      *     ),
      *     @OA\Response(
      *         response=422,
      *         description="Erreurs de validation",
      *         @OA\JsonContent(
      *             @OA\Property(property="success", type="boolean", example=false),
      *             @OA\Property(property="message", type="string", example="voici la lise les errors compises"),
      *             @OA\Property(property="errors", type="object")
      *         )
      *     ),
      *     @OA\Response(
      *         response=500,
      *         description="Erreur serveur",
      *         @OA\JsonContent(
      *             @OA\Property(property="success", type="boolean", example=false),
      *             @OA\Property(property="message", type="string"),
      *             @OA\Property(property="errors", type="object")
      *         )
      *     )
      * )
      */
     public function store(CreateCompte $request)
     {
          $compte = $this->compteService->create($request->validated());
          return $this->successResponse("compte creer avec succes", $compte, 200);
     }
     
}
