<?php

namespace App\Http\Controllers\Lot;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lot\LotRequest;
use App\Models\Category;
use App\Models\Lot;
use App\Models\LotCategory;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LotController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $per_page=$request->per_page ?? 10;

        return $this->dataResponse(Lot::query()->with('categories')->paginate($per_page));
    }

    public function store(LotRequest $lotRequest)
    {
        $lotRequest->validated();

        $lot=Lot::query()->create($lotRequest->only(['name','description']));
        return $this->successResponse($lot,Response::HTTP_CREATED);
    }

    public function show(Lot $lotId)
    {
        return $this->dataResponse($lotId,Response::HTTP_OK);
    }

    public function update(Request $request,Lot $lotId)
    {
        $this->validate($request,[
           'name'=>'nullable|min:3|max:55',
           'description'=>'nullable|min:3|max:255',
        ]);

        $lotId->name=$request->name;
        $lotId->description=$request->description;
        $lotId->save();

        return $this->dataResponse($lotId,Response::HTTP_OK);
    }

    public function delete(Lot $lotId)
    {
        $lotId->delete();
        return $this->successResponse(trans('response.theLotDeletedSuccessfully'),Response::HTTP_OK);
    }

    public function addCategory(Request $request,Lot $lotId)
    {
        $category=Category::query()->firstOrCreate([
            'name'=>$request->name
        ]);

        $lotCategory=new LotCategory();
        $lotCategory->lot_id=$lotId->id;
        $lotCategory->category_id=$category->id;
        $lotCategory->save();

        return $this->dataResponse($lotCategory,Response::HTTP_CREATED);
    }

    public function filter(Request $request)
    {
        $per_page=$request->per_page ?? 10;
        $lot=Lot::query()
            ->whereHas('categories',function ($q) use ($request){
                return $q->where('name','like','%'.$request->category.'%');
            })
            ->paginate($per_page);
        return $this->dataResponse($lot);
    }
}
