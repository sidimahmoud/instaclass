<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\SubCategory;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $cats = Category::where('name_fr', '!=', 'no_categorie')->with("subCategories")->get();
        return response()->json($cats);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $category = new Category();
        $category->name_en = $request['name'];
        $category->name_fr = $request['nom'];
        if ($request->hasFile('image')) {
            $file = $request['image'];
            $extension = $file->getClientOriginalExtension();
            $file_name = $request['name'] . "-" . time() . "." . $extension;
            $file->move('uploads/categories/', $file_name);
            $category->image = 'uploads/categories/' . $file_name;
        } else
            $category->image = $request['image'];
        $category->save();

        if ($category)
            return response()->json(["response" => "category created successfully"]);
        return response()->json(["response" => "error"]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $category = Category::where('id', $id)->get();
        return response()->json($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
       // return $request->all();
        $category = Category::find($id);
        /* $category->name_en = $request['name_en'];
        $category->name_fr = $request['name_fr'];
        if ($request->hasFile('image')) {
            $category->image = $request['image'];
            $file = $request['image'];
            $extension = $file->getClientOriginalExtension();
            $file_name = $request['name'] . "-" . time() . "." . $extension;
            $file->move('uploads/categories/', $file_name);
            $category->image = 'uploads/categories/' . $file_name;
        } */
        $category->image = $request['image'];
        $category->save();
        if ($category)
            return response()->json(["response" => "category updated successfully"]);
        return response()->json(["response" => "error"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        //dd($id);
        $category = Category::find($id);
        $category->delete();
        return response()->json(["response" => "category deleted"]);
    }

    /**
     * Remove the specified resource from storage.
     * @return JsonResponse
     */
    public function getNoCategorie()
    {
        $cat = SubCategory::where('name_fr', '=', 'no_sub_categorie')->first();
        info($cat);
        return response()->json($cat);
    }
}
