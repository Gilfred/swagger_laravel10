<?php

namespace App\Http\Controllers;

use App\Models\Prduct;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;

class ProductController extends Controller
{
        /**
     * @OA\Get(
     * path="/api/products",
     * summary="Liste des utilisateurs",
     * @OA\Response(response="200", description="Liste des utilisateurs")
     * )
     */
        //
    public function index(){
        return Prduct::all();
    }

   /**
 * @OA\Post(
 * path="/api/products",
 * summary="Créer un nouveau produit",
 * description="Ajout d'un nouvel produit dans la base de donnée",
 * @OA\RequestBody(
 * required=true,
 * @OA\JsonContent(
 * required={"name","description", "price"},
 * @OA\Property(property="name", type="string", example="John Doe"),
 * @OA\Property(property="description", type="string", example="description de l'élément"),
 * @OA\Property(property="price", type="number", example=15452)
 * )
 * ),
 * @OA\Response(
 * response=201,
 * description="Produit enrégistré avec succès!",
 * @OA\JsonContent(
 * @OA\Property(property="id", type="integer", example=1),
 * @OA\Property(property="name", type="string", example="John Doe"),
 * @OA\Property(property="description", type="string", example="tout est bon!"),
 * @OA\Property(property="price", type="number", example=15452)
 * )
 * ),
 * @OA\Response(response=400, description="Données invalides"),
 * @OA\Response(response=500, description="Erreur interne du Serveur")
 * )
 */
    public function store(Request $request){
        $regle=[
            'name'=>['string', 'required',],
            'description'=>['string', 'required',],
            'price'=>['required','numeric'],
        ];
        $validated=$request->validate($regle);
        $product= Prduct::create($request->all());
        return response()->json([$product],201);
    }

    /**
     * @OA\Get(
     * path="/api/special_products/{product}",
     * summary="affichage d'un élément spécial",
     * @OA\Response(response="200" ,description="Affichage d'un élément spécifique depuis la DB a travers son ID")
     * )
     */
    public function show(Prduct $product){
        if(!$product){
            return response()->json([
                'message'=>"L'élément recherché n'existe pas",
            ],404);
        }
        return response()->json([$product],200);
    }

/**
 * @OA\Delete(
 * path="/api/products/{product}",
 * summary="Suppression d'un produit",
 * description="Suppression du produit à partir de l'identifiant ID",
 * @OA\Parameter(
 * name="product",
 * in="path",
 * required=true,
 * description="ID du produit à supprimer",
 * @OA\Schema(type="integer")
 * ),
 * @OA\Response(
 * response=200,
 * description="Produit supprimé avec succès",
 * @OA\JsonContent(
 * @OA\Property(property="id", type="integer", example=1),
 * @OA\Property(property="name", type="string", example="Nom du produit"),
 * @OA\Property(property="description", type="string", example="Description du produit"),
 * @OA\Property(property="price", type="number", example=10.99)
 * )
 * ),
 * @OA\Response(
 * response=404,
 * description="Produit non trouvé",
 * @OA\JsonContent(
 * @OA\Property(property="message", type="string", example="L'élément que vous désirez supprimer n'existe pas!")
 * )
 * ),
 * @OA\Response(
 * response=500,
 * description="Erreur interne du serveur"
 * )
 * )
 */
    public function destroy(Prduct $product){
        if(!$product){
            return response()->json([
                'message'=>"L'élément que vous désirez supprimer n'existe pas!"
            ],404);
        }
        $product->delete();
        return response()->json([
            $product,
            "message"=>"Cette information a été supprimer avec succès!"
        ],200);
    }

    /**
     * @OA\Put(
     * path="/api/products/{product}",
     * summary="mise à jour de la données",
     * description="mise a jour de la donnée à travers l'identifiant",
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(
     * @OA\Property(property="name", type="string", example="Papa"),
     * @OA\Property(property="description", type="string", example="Bon Père"),
     * @OA\Property(property="price", type="number", example=258)
     * )
     * ),
     * @OA\Response(
     * response=200,
     * description="Information mise a jour avec succès!",
     * @OA\JsonContent(
     * @OA\Property(property="name", type="string", example="Papa"),
     * @OA\Property(property="description", type="string", example="Bon Père"),
     * @OA\Property(property="price", type="number", example=258)
     * )
     * ),
     * @OA\Response(response=404, description="La mise a jour n'a pas été validé ou le produit n'existe pas")
     * )
     */
    public function update(Request $request, Prduct $product){
        $request->validate([
            'name'=>['string', 'required',],
            'description'=>['string', 'required',],
            'price'=>['required','numeric'],
        ]);
        $product->update($request->all());
        return response()->json([
            $product,
            "message"=>"Mise a Jour Effectuée avec Succès!"
        ],200);
    }
}
