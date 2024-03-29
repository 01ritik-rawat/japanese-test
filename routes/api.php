<?php

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('greetings', [Controller::class ,'greetings']);

Route::group(['prefix' => '{recipes}'], function() {
    Route::get('', [Controller::class ,'getAllRecipes']);
    Route::get('/{id}', [RecipeController::class, 'getRecipeById']);
    Route::post('', [Controller::class ,'createRecipe']);
    Route::patch('/{id}', [Controller::class, 'updateRecipe']);
    Route::delete('/{id}', [Controller::class, 'deleteRecipe']);
    
    



});


Route::get('/check-connection', function () {
    return response()->json(['message' => "We're connected"]);
});