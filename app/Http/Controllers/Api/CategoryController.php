<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CategoryResource::collection(Category::all('id', 'name')); // Returning specified data using resource.
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // First - less secure
    // public function store(Request $request)
    // return Category::create(['name' => $request->name]);

    // Second - more secure
    // public function store(StoreCategoryRequest $request)
    // return new Category::create($request->validated());

    // Third - even more secure and controls what fields to return
    // public function store(StoreCategoryRequest $request)
    // return new CategoryResource(Category::create($request->validated()));

    public function store(StoreCategoryRequest $request)
    {
        return new CategoryResource(Category::create($request->validated()));
        // validated() - is a function that return all the fields that are listed StoreCategoryRequest.php rules() method.
        // $request->all() - return all fields - not secure!
        // store() method in Laravel return status code 201 (created), not 200 (ok)!
        // if validation will fail, 422 status code will be returned.
        // Validation errors will be in the object "errors" with arrays of messages.
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
//        $category = Category::find($id);
//        if (!$category) {
//            abort(404, 'No category found!');
//        }

        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    // Use PUT or PATCH method to submit data for update.
    public function update(StoreCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return new CategoryResource($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    // Use DELETE method to delete record.
    {
        $category->delete();

        return response()->noContent(); // noContent() - returns 204 status (No Content).
    }
}
