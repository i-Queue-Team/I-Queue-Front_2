<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Utils\Auth\AuthTools;
use App\Utils\Responses\IQResponse;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function show(User $user)
    {
        if (AuthTools::checkUserId($user)) {
            return IQResponse::response(Response::HTTP_OK, User::find($user->id));
        } else {
            return IQResponse::errorResponse(Response::HTTP_FORBIDDEN);
        }
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy(User $user)
    {
        if (AuthTools::checkUserId($user)) {
            $user->delete();
            return IQResponse::emptyResponse(Response::HTTP_NO_CONTENT);
        } else {
            return IQResponse::errorResponse(Response::HTTP_FORBIDDEN);
        }
    }

    // User Register
    public function register(Request $request)
    {
        $validator  =   Validator::make($request->all(), [
            "name"  =>  "required",
            "email"  =>  "required|email|unique:users",
            "password"  =>  "required",
            "role" => "in:USER,ADMIN",
        ]);

        if ($validator->fails()) {
            return IQResponse::errorResponse(Response::HTTP_BAD_REQUEST, $validator->errors());
        }

        $inputs = $request->all();
        $inputs["password"] = Hash::make($request->password);
        $inputs["role"] = $request->role ? $request->role : 'USER';
        $user   =   User::create($inputs);

        if (!is_null($user)) {
            return IQResponse::response(Response::HTTP_OK, $user);
        } else {
            return IQResponse::emptyResponse(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }



    // User login
    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "email" =>  "required|email",
            "password" =>  "required",
        ]);

        if ($validator->fails()) {
            return IQResponse::errorResponse(Response::HTTP_BAD_REQUEST, $validator->errors());
        }

        $user = User::where("email", $request->email)->first();

        if (is_null($user)) {
            return IQResponse::emptyResponse(Response::HTTP_NOT_FOUND);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user   = Auth::user();
            $token  = $user->createToken('token')->plainTextToken;
            $user->token = $token;
            return IQResponse::response(Response::HTTP_OK, $user);
        } else {
            return IQResponse::emptyResponse(Response::HTTP_UNAUTHORIZED);
        }
    }

    public function authenticateWeb(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "email" =>  "required|email|exists:users",
            "password" =>  "required",
        ]);
        if ($validator->fails()) {
            return view('login')->with('errors', $validator->errors());
        }
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            return redirect()->intended('dashboard');
        } else {
            $validator->getMessageBag()->add('email', 'credenciales erroneas');
            return view('login')->with('errors', $validator->errors());
        }
    }
    public function registerWeb(Request $request)
    {

        $validator  =   Validator::make($request->all(), [
            "name"  =>  "required",
            "email"  =>  "required|email|unique:users",
            "password"  =>  "required",
            "role" => "in:USER,ADMIN",
        ]);
        if ($validator->fails()) {
            return view('registro')->with('errors', $validator->errors());
        }

        $inputs = $request->all();
        $inputs["password"] = Hash::make($request->password);
        $inputs["role"] = $request->role ? $request->role : 'USER';
        $user   =   User::create($inputs);


        if (!is_null($user)) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->intended('dashboard');
            }else {
                $validator->getMessageBag()->add('email', 'credenciales erroneas');
                return view('login')->with('errors', $validator->errors());
            }
        }
    }
    public function logout()
    {
        //logout user
        Auth::logout();
        // redirect to homepage
        return redirect('/');
    }
}
