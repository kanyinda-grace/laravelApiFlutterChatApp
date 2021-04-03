<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;


class ApiAuthController extends Controller
{
    //
    public function register(Request $request){
    try {
         $validator = Validator::make($request->all() ,[
            'name'=> 'required' ,
            'email'=> 'required|email',
            'password'=> 'required',
            'c_password'=>'required|same:password',

            ]);

        if($validator->fails()){
            return response()->json($validator->errors() , 202);
        }
        $allData = $request->all();
        $allData['password'] = bcrypt($allData['password']);

        $user = User::create($allData);

        $resArr = [];
        $resArr['token'] = $user->createToken('api_application')->accessToken;

        return response()->json($resArr, 200);

    } catch (Exception $e) {
        return print($e);
    }
    }
    

    public function login(Request $request){
       // return $request;
        if(Auth::attempt([

            'email'=>$request->email,
            'password'=>$request->password
        ])){
            $user = Auth::user();
            $resArr = [];
            $resArr['token']=$user->createToken('api_application')->accessToken;
            $resArr['name']=$user->name;

            return response()->json($resArr , 200);
        }else{
            return response()->json(['error' => 'Unautorized Access'] , 203);
        }
    }
}
