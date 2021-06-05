<?php

namespace App\Http\Controllers;

use App\Models\Statistic;
use App\Models\Currentqueue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\QueueVerifiedUser;
use App\Utils\Queue\QueueTools;
use App\Utils\Responses\IQResponse;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Commerce;
use Illuminate\Validation\ValidationException;

class QueueVerifiedUsersController extends Controller
{

    // store user in queue
    public function store(Request $request)
    {

        if (QueueTools::already_in_queue($request->user_id,  auth()->id())) {
            $request->request->add(['being_null_in_queue' => 'value']);
        }
        //validate queue
        $validator  =   Validator::make($request->all(), [
            "queue_id"  =>  "required|integer|exists:current_queues,id",
            "password_verification"  =>  "required|exists:current_queues,password_verification",
            "being_null_in_queue"  =>  "required",
        ]);
        if ($validator->fails()) {
            return IQResponse::errorResponse(Response::HTTP_BAD_REQUEST, $validator->errors());
        }
        //queue instance
        $queueVerifiedUser = new QueueVerifiedUser();
        $queueVerifiedUser->queue_id = $request->queue_id;
        $queueVerifiedUser->user_id =  auth()->id();
        //name
        $commerce = Commerce::find($request->queue_id);
        $queueVerifiedUser->name = $commerce->name;
        //posicion es igual a la funcion posicion
        $queueVerifiedUser->position = QueueTools::position($request->queue_id);
        //el tiempo estimado sera el actual con la adicion de los minutos recibidos de la funcion de tiempo estimado
        $queueVerifiedUser->estimated_time = date('Y-m-d H:i:s');
        $queueVerifiedUser->save();
        QueueTools::refresh_estimated_time($request->queue_id);
        QueueTools::store_statistic($request);
        if (!is_null($queueVerifiedUser)) {
            return IQResponse::response(Response::HTTP_CREATED, $queueVerifiedUser);
        } else {
            return IQResponse::emptyResponse(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function index()
    {
        // for testing
        return IQResponse::response(Response::HTTP_OK,QueueVerifiedUser::all()->where('user_id', '=', auth()->id()));

    }
    public function destroy($queue_id)
    {
        //delete function
        $inputs['user_id'] = auth()->id();
        $user = QueueVerifiedUser::all()->where('queue_id','=',$queue_id)->where('user_id', '=', auth()->id())->first();

        if ($user) {
            $position = $user->position;
            $queue_id = $user->queue_id;
            QueueTools::refresh_position($queue_id, $position);
            QueueTools::refresh_estimated_time($queue_id);
            $user->delete();
        }
        if (!is_null($user)) {
            return IQResponse::emptyResponse(Response::HTTP_OK, $user);
        } else {
            return IQResponse::emptyResponse(Response::HTTP_NOT_FOUND);
        }
    }
    //entry function that checks whether a user can enter the establisment and does so if posible
    public function entry_check($user_id,$queue_id)
    {

        $user = QueueVerifiedUser::all()->where('queue_id','=',$queue_id)->where('user_id', '=', $user_id)->first();
        if ($user) {
            $position = $user->position;
            $queue_id = $user->queue_id;
            if ($position == 1) {
                // delete user from queue
                QueueTools::refresh_position($queue_id, $position);
                QueueTools::refresh_estimated_time($queue_id);
                $user->delete();
                return IQResponse::response(Response::HTTP_OK, $user);
            } else {
                return IQResponse::emptyResponse(Response::HTTP_CONFLICT);
            }
        }
        if (!is_null($user)) {
            return IQResponse::emptyResponse(Response::HTTP_NO_CONTENT);
        } else {
            return IQResponse::emptyResponse(Response::HTTP_NOT_FOUND);
        }
    }
    //function to get user info from queue
    public function info($user_id)
    {
        $user = QueueVerifiedUser::where('user_id', $user_id)->first();
        if ($user) {

            // delete user from queue
            return IQResponse::response(Response::HTTP_OK, $user);
        }
        if (!is_null($user)) {
            return IQResponse::response(Response::HTTP_OK, $user);
        } else {
            return IQResponse::emptyResponse(Response::HTTP_NOT_FOUND);
        }
    }
}


//TODO: implementar estas funciones

//funcion tiempo estimado
