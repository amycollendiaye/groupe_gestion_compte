<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCompte;
use App\Http\Resources\CompteResource;
use App\Http\Services\CompteService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class CompteController extends Controller
{
     use ApiResponse;

     protected CompteService $compteService;

     public  function __construct(CompteService $compteService)
     {
          $this->compteService = $compteService;
     }

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
     
     public function store(Request $request)
     {
          $createCompte = new CreateCompte();
          $validator = validator($request->all(), $createCompte->rules(), $createCompte->messages());
          if ($validator->fails()) {
               return $this-> errorResponse(  "voici la lise les errors compises",'422',['errors' => $validator->errors()]);
          }
          $compte = $this->compteService->create($request->all());
          return $this->successResponse("compte creer avec succes", $compte, 200);
     }
     
}
