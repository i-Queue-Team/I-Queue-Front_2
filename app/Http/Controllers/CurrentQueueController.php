<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\CurrentQueue;
use App\Utils\Responses\IQResponse;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class CurrentQueueController extends Controller
{
    public function index(){
        return IQResponse::response(Response::HTTP_OK,CurrentQueue::all());
    }
    public function show($id){
        $queue = CurrentQueue::find($id);
        if ($queue) {
            return IQResponse::response(Response::HTTP_OK,$queue);
        } else {
            return IQResponse::emptyResponse(Response::HTTP_NOT_FOUND);
        }
    }
    // store queue
    public function store(Request $request)
    {
        //validate queue
        $validator  =   Validator::make($request->all(), [
            "fixed_capacity"  =>  "required|integer",
            "average_time"  =>  "required|integer",
            //if exists and is valid
            "commerce_id"=>"required|integer|exists:commerces,id|unique:current_queues,commerce_id"
        ]);

        if ($validator->fails()) {
            return IQResponse::errorResponse(Response::HTTP_BAD_REQUEST,$validator->errors());
        }
        //queue instance
        $queue = new CurrentQueue();
        $queue->fixed_capacity = $request->fixed_capacity;
        $queue->average_time = $request->average_time;
        $queue->commerce_id = $request->commerce_id;
        $queue->password_verification = Str::random(10);
        $queue->save();
        if (!is_null($queue)) {
            return IQResponse::response(Response::HTTP_CREATED,$queue);
        } else {
            return IQResponse::emptyResponse(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
