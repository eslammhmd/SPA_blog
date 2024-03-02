<?php

namespace App\Http\Controllers;

use App\Models\Category;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'name' => ['required' , 'string'],
        ]);
        $name = $request->input('name');
        // dd($name);
        $category = new Category();
        $category->name = $name;
        return $category->save();
    }



    public function index(){
        return  Category::latest()->get();
    }


    public function show(Category $category){
        return $category;
    }


    public function update(Request $request , Category $category){
        $request->validate([
            'name' => ['required' , 'string'],
        ]);
        $name = $request->input('name');
        $category->name = $name;
        return $category->save();
    }



    public function destroy(Category $category){
        return $category -> delete();
    }
// for chart js
    public function getData()
{
    $categories = Category::withCount('posts')->get();
    // return response()->json($categories, 204);

    // return view('categories.index', compact('categories'));
    return $categories;
}
}
