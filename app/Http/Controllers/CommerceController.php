<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommerceResource;
use App\Models\Commerce;
use Illuminate\Support\Str;
use App\Models\CurrentQueue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Utils\Responses\IQResponse;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;


class CommerceController extends Controller
{

    function index()
    {
        return IQResponse::response(Response::HTTP_OK,Commerce::all());
    }

    public function show($id){
        $commerce = Commerce::find($id);
        $queue = $commerce->Queue;
        if ($commerce) {
            return IQResponse::response(Response::HTTP_OK,$commerce,$queue);
        } else {
            return IQResponse::emptyResponse(Response::HTTP_NOT_FOUND);
        }
    }

    // store commerce
    public function store(Request $request)
    {
        $validator  =   Validator::make($request->all(), [
            "name"      =>  "required|unique:commerces,name",
            "latitude"  =>  "required",
            "longitude" =>  "required",
            "image"     =>  "required|image|mimes:jpeg,png,jpg|max:2048",
        ]);
        if ($validator->fails()) {
            return IQResponse::errorResponse(Response::HTTP_BAD_REQUEST,$validator->errors());
        }

        $inputs = $request->all();
        $inputs['user_id'] = auth()->id();
        DB::beginTransaction();
        $commerce   =   Commerce::create($inputs);
        $queue = new CurrentQueue([
            'commerce_id' => $commerce,
        ]);
        $commerce->queue()->save($queue);
        $image = $request->file('image');
        $imageName = Str::random(20) . '.' . $image->extension();
        Storage::disk('public')->put('commerces/' . $imageName,file_get_contents($request->image));
        $commerce->image = $imageName;
        $commerce->save();
        DB::commit();
        if (!is_null($commerce)||!is_null($queue) ) {
            return IQResponse::response(Response::HTTP_OK,new CommerceResource($commerce));
        } else {

            return IQResponse::emptyResponse(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function update(Commerce $commerce, Request $request){
        //TODO IMPLEMENT
        return IQResponse::emptyResponse(Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function destroy(Commerce $commerce){
        //TODO IMPLEMENT
        return IQResponse::emptyResponse(Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
