<?php

namespace App\Utils\Queue;

use App\Models\Statistic;
use App\Models\CurrentQueue;
use Illuminate\Http\Request;
use App\Models\QueueVerifiedUser;
use Illuminate\Support\Facades\DB;
use App\Utils\Responses\IQResponse;
use Symfony\Component\HttpFoundation\Response;

class QueueTools
{
    // store user in queue
    public static function store_statistic(Request $request)
    {
        //validate queue
        //queue instance
        $QueueVerifiedUser = new Statistic();
        $QueueVerifiedUser->queue_id = $request->queue_id;
        $QueueVerifiedUser->user_id = $request->user_id;
        //posicion es igual a la funcion posicion
        $QueueVerifiedUser->position = self::position($request->queue_id);
        //el tiempo estimado sera el actual con la adicion de los minutos recibidos de la funcion de tiempo estimado
        $QueueVerifiedUser->estimated_time = date('Y-m-d H:i:s');
        $QueueVerifiedUser->save();
        //return IQResponse::emptyResponse(Response::HTTP_NO_CONTENT);
    }
    //function to give the corresponding position to users depending on where they are in the queue
    public static function refresh_position(int $queue_id, int $user_position)
    {
        QueueVerifiedUser::where('queue_id', $queue_id)
            ->where('position', '>', $user_position)
            ->update(
                ['position' => DB::raw('position-1')],
            );
    }
    //function to give the corresponding position to users depending on where they are in the queue
    public static function refresh_estimated_time(int $queue_id)
    {
        $queue = CurrentQueue::find($queue_id);
        $average_time = $queue->average_time;
        $users = QueueVerifiedUser::all()->where('queue_id', $queue_id);
        foreach ($users as $user) {
            date_default_timezone_set('Europe/Madrid');
            $position = $user->position;
            $currentDate =  date('Y-m-d H:i:s');
            $newDate = date("Y-m-d H:i:s", strtotime($currentDate . " +" . $average_time * $position . " minutes"));
            $user->update(['estimated_time' => $newDate]);
        }
    }
    // retrieve position
    public static function position($queue_id)
    {
        return QueueVerifiedUser::all()->where('queue_id', '=', $queue_id)->count() + 1;
    }
    public static function already_in_queue($user_id,$queue_id){
        $isInQueue = DB::select( DB::raw("select * from queue_verified_users where user_id = $user_id and queue_id = $queue_id"));
        return empty($isInQueue);

    }
}
