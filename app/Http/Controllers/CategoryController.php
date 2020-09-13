<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $cats = Category::all();
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request['name'];
        $category->description = $request['description'];
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
     * @return \Illuminate\Http\JsonResponse
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
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, Request $request )
    {
        $category = Category::find($id);
        $category->name = $request['name'];
        $category->description = $request['description'];
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
            return response()->json(["response" => "category updated successfully"]);
        return response()->json(["response" => "error"]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if (Gate::denies('only-admin')) {
            return response()->json(["response" => 'unauthorized'], 403);
        }
        $category = Category::find($id);
        $category->delete();
        return response()->json(["response" => "category deleted"]);

    }
}
