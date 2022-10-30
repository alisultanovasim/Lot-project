<?php

namespace App\Http\Controllers\Lot;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lot\CategoryRequest;
use App\Http\Requests\Lot\LotRequest;
use App\Models\Category;
use App\Models\Lot;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $per_page=$request->per_page ?? 10;

        return $this->dataResponse(Category::query()->with('lots')->paginate($per_page));
    }

    public function store(CategoryRequest $categoryRequest)
    {
        $categoryRequest->validated();
        $check=Category::query()->whereName($categoryRequest->name)->first();

        if ($check)
            return $this->errorResponse(trans('response.theCategoryAlreadyExist'),Response::HTTP_BAD_REQUEST);

        $category=Category::query()->create($categoryRequest->only(['name']));
        return $this->successResponse($category,Response::HTTP_CREATED);
    }

    public function show(Category $catId)
    {
        return $this->dataResponse($catId,Response::HTTP_OK);
    }

    public function update(Request $request,Category $catId)
    {
        $this->validate($request,[
            'name'=>'nullable|min:3|max:55',
            'description'=>'nullable|min:3|max:255',
        ]);

        $catId->name=$request->name;
        $catId->save();

        return $this->dataResponse($catId,Response::HTTP_OK);
    }

    public function delete(Category $catId)
    {
        $catId->delete();
        return $this->successResponse(trans('response.theCategoryDeletedSuccessfully'),Response::HTTP_OK);
    }
}
