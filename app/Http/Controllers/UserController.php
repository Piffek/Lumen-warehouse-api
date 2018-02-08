<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\JWTAuth;
use App\User_Warehouse;


class UserController extends Controller
{
    private $users;

    /**
     * @var \Tymon\JWTAuth\JWTAuth
     */
    protected $jwt;
    protected $user_Warehouse;

    public function __construct(User $users, JWTAuth $jwt, User_Warehouse $user_Warehouse)
    {
        $this->users = $users;
        $this->jwt = $jwt;
        $this->user_Warehouse = $user_Warehouse;
    }

    public function auth(Request $request)
    {

        $credentials = $request->only('email', 'password');
        $user = null;
        try {

            if (!$token = $this->jwt->attempt($credentials)) {
                return response()->json(['msg' => 'Błędne dane'], 404);
            }

            $this->users->where('email', $request->input('email'))->update(['_token' => $token]);
//            $user = New User();
           $currentUser = $this->users->where('email', $request->email)->first();

        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], 500);

        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], 500);

        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent' => $e->getMessage()], 500);

        }
        //return response()->json(['msg' => 'success']);
        return response()->json(['email' => $request->email,'isAdmin' => $currentUser->isAdmin,'id' => $currentUser->id, 'token' => $token ]);

    }


    public function all()
    {
        $user = $this->jwt->authenticate();

        if ($user->isAdmin) {
            return response()->json($this->users->all());
        } else {
            return response()->json(['msg' => 'Brak dostępu'], 404);
        }
    }


    public function register(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:user',
            'password' => 'required',
        ]);

        $this->users->store($request);

        return response()->json(['success' => 'rejestracja przebiegla pomyslnie']);
    }

    public function warehouseForUser($id)
    {

        $warehouses = $this->users->find($id)->warehouse;


        if (isset($warehouses)) {
            return response()->json($warehouses);
        } else {
            return response()->json(['msg' => 'brak uzytkonika o takim id'],400);
        }
        //test
    }

    public function addUserToWarehouse(Request $request)
    {
        if ($this->user_Warehouse->create($request->all())) {
            return response()->json(['msg' => 'dodano']);
        } else {
            return response()->json(['msg' => 'error'],400);
        }
    }

    public function allUsers(Request $request)
    {
        $checkIsAdmin = $this->users->where('email', $request->email)->first();
        if ($checkIsAdmin->isAdmin) {
            return response()->json($this->users->all());
        } else {
            return response()->json(['msg' => 'error'],400);
        }
    }

}
