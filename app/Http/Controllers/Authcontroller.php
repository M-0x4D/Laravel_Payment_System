<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Client;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\ResetPassword;



class Authcontroller extends Controller
{
    //

    function register(Request $request)
    {

       // mohamed_validation();

        $validator = validator()->make($request->all() , [
            'name' => 'required',
            'email' => 'required',
            'phone' => ['required' , 'unique:clients' ],
            'password' => ['required' , ],
            'city_id' => 'required'
        ]);

       

        if ($validator->fails()) {
            # code...
             return response()->json("test");
        }

        else {
            
        
        $phone = Client::where('phone' , $request->phone)->first();
        if($phone == NULL)
        {
        $request->merge(["password" => bcrypt($request->password)]);
        $client = Client::create($request->all());
        $client->api_token = Str::random(60);
        $client->save();
        $client->client_role()->attach(4 , ['model_type' => 'test' , 'model_id' => $client->id]);
        return $client;

        }
        else
        {
            return response()->json(['msg' => 'failed']);
        }
            
        }
        
    }



    function login(Request $request)
    {

        $validator = validator()->make($request->all() , [

            'phone' => 'required',
            'password' => 'required',
            
        ]);


        if ($validator->fails()) {
            # code...
             return response()->json(['msg'=>"failed"]);
        }



        if (Auth::guard('client_web')->validate(['phone' => $request->phone , 'password' => $request->password])) {

            # code...
            $client = Client::where('phone' , $request->phone)->first();

            return response()->json(['token' =>  $client->api_token ,'msg' => $client]);

        }
        else {
            
            return response()->json(['msg' => 'not log in ']);
        }
   /////////////////////////////////////////////////////////////     
        $client = Client::where('phone' , $request->phone)->first();
        if($client)
        {
            if(Hash::check($request->password , $client->password))
            {
                return response()->json(['api_token' => $client->api_token , 'user'=>$client]);

            }
            
        }
        else
        {
            return response()->json(['user'=> "no user"]);
        }

        // $check = auth()->validate($request->all());

        // if($check)
        // {
        //     return auth()->api_tokem;
        // }
        // else
        // {
        //     return "failed";
        // }
        
         
            
        
        
       
    }

    function reset_password(Request $request)
    {
        $user = $request->user();
        
        $code = rand(1111 , 9999);
        $update = $user->update(['pin_code' => $code]);
        if ($update) {
            # code...
            Mail::to(env('MAIL_LOG_CHANNEL'))->send(new ResetPassword($code));
        return response()->json(['code' => 'password reset with code : ' . $code , 'fails' => Mail::failures()]);
        }
        else {
            
            return "failed";
        }
        
        
    }

    function new_password(Request $request)
    {
        if ($request->pin_code == $request->user()->pin_code && $request->password === $request->confirm_password) {
            # code...
            
            $user = $request->user();
            $update = $user->update(['password' =>  bcrypt($request->password) , 'pin_code' => NULL ]);
            return response()->json(['msg' => 'تم تغيير الباسوورد بنجاح']);
        }
        else {
            
            return response()->json(['msg' => 'فشل في تغيير كلمه السر']);
        }
        
    }
}
