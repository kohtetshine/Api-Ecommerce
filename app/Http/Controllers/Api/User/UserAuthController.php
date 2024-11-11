<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Repositories\API\UserRepo;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserAuthController extends Controller
{

    public $userRepo;
    public function __construct(
        UserRepo $userRepo
    )
    {
        $this->userRepo = $userRepo;
    }
    public function register(Request $request)
    {
        try {
            $validation = Validator::make($request->all(), ([
                'name' => 'required',
                'email' => 'required_without:phone|email|unique:users',
                'phone' => 'required_without:email|unique:users',
                'password' => 'required|min:6',
            ]));

            if ($validation->fails()) {
                throw new \Exception($validation->errors()->first());
            }

            if(isset($request['email'])){
                $request['login_type_id']=1;
            }else{
                $request['login_type_id']=2;
            }

            $request['password'] = bcrypt($request['password']);
            $request['remember_token'] = Str::random(10);

            $this->userRepo->insert($request->all());

            $response = [
                'name' => $request['name'],
                'email' => $request['email'],
                'phone' => $request['phone'],
            ];
            return response()->json(['message' => 'User Registered Successfully with email ' . $request['email'], 'data' => $response ], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 400);
        }
    }

    public function login(Request $request)
    {
        try {
            $validation = Validator::make($request->all(), ([
                'email' => 'required_without:phone',
                'phone' => 'required_without:email',
                'password' => 'required',
            ]));

            if ($validation->fails()) {
                throw new \Exception($validation->errors()->first());
            }

            $user = $this->userRepo->findBy('phone', $request['phone']);
            if ($user) {
                $user = $this->userRepo->findBy('email', $request['email']);
                if ($user) {
                    if (password_verify($request['password'], $user->password)) {

                        $token = $this->userRepo->getToken($user->id);

                        $response = [
                            'name' => $user->name,
                            'email' => $user->email,
                            'phone' => $user->phone,
                            'token' => $token
                        ];
                        return response()->json(['message' => 'User Logged In Successfully', 'data' => $response ], 200);
                    } else {
                        throw new \Exception('Password does not match');
                    }
                } else {
                    throw new \Exception('User does not exist');
                }
            } else {
                throw new \Exception('User does not exist');
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 400);
        }
    }
}
