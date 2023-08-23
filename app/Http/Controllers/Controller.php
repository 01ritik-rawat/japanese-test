<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function greetings(){
        print("1, 2, 3, 4 ...");
        return "hi this is Ritik";
    }

    public function getAllRecipes()
    {


        $recipes = DB::table('recipes')->get();
        return response()->json(['recipes' => $recipes]);

        
    }
    public function createRecipe(Request $request)
    {
        $title = $request->input('title');
        $makingTime = $request->input('making_time');
        $serves = $request->input('serves');
        $ingredients = $request->input('ingredients');
        $cost = $request->input('cost');

        $query = "
            INSERT INTO recipes (title, making_time, serves, ingredients, cost)
            VALUES (?, ?, ?, ?, ?)
        ";

        $data= DB::insert($query, [$title, $makingTime, $serves, $ingredients, $cost]);

        return response()->json(['message' => 'Recipe successfully created', 'recipe'=> $data]);
    }
    
    public function updateRecipe(Request $request, $id)
    {
        $title = $request->input('title');
        $makingTime = $request->input('making_time');
        $serves = $request->input('serves');
        $ingredients = $request->input('ingredients');
        $cost = $request->input('cost');

        $query = "
            UPDATE recipes
            SET title = ?, making_time = ?, serves = ?, ingredients = ?, cost = ?
            WHERE id = ?
        ";

        DB::update($query, [$title, $makingTime, $serves, $ingredients, $cost, $id]);

        return response()->json(['message' => 'Recipe updated successfully']);
    }

    public function deleteRecipe($id)
    {
        DB::table('recipes')->where('id', $id)->delete();

        return response()->json(['message' => 'Recipe deleted successfully']);
    }

    public function getRecipeById($id)
    {
        $recipe = DB::table('recipes')->where('id', $id)->first();

        return response()->json($recipe);
    }

}
