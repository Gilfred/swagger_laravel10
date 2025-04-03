<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
 


/**
 * @OA\Info(
 *     title="CRUD de produit",
 *     version="1.0.0",
 *     description="Documentation de l'API pour gérer les produits",
 *     @OA\Contact(
 *         email="yaovimawulomdegbevi@gmail.com"
 *     ),
 *     @OA\License(
 *         name="MIT",
 *         url="https://opensource.org/licenses/MIT"
 *     )
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    
}
