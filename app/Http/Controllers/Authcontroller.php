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
        $validator = validator()->make($request->all() , [
            'name' => 'required',
            'email' => 'required',
            'phone' => ['required' , 'unique:clients' ],
            'password' => ['required' , ],
            'city_id' => 'required' ,
            'balance' => 'required',
            'date_of_birth' => 'required' ,
            'governrate_id' => 'required'
        ]);
        if ($validator->fails()) {
            # code...
             return json_return(0 , 'failed' , 'validation error');
            }
        else {
        $phone = Client::where('phone' , $request->phone)->first();
        if($phone == NULL)
        {
        $request->merge(["password" => bcrypt($request->password)]);
        $client = Client::create($request->all());
        $client->api_token = Str::random(60);
        $client->status = true;
        $client->save();
        $client->client_role()->attach(4 , ['model_type' => 'test' , 'model_id' => $client->id]);
        return json_return(1 , 'success' , $client);
        }
        else
        {
            return json_return(0 , 'failed' , 'this phone is taken by another user');
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
             return json_return(0 , 'failed' , 'no data');
        }
        if (Auth::guard('api_web')->validate(['phone' => $request->phone , 'password' => $request->password])) {
            $client = Client::where('phone' , $request->phone)->first();
            if($client)
        {
            if(Hash::check($request->password , $client->password))
            {
                 return json_return(1,'success',['api_token' =>  $client->api_token ,'user' => $client]);

            }
            else
        {
            return json_return(0,'failed','password is not valid');
        }
            
        }
        else
        {
            return json_return(0,'failed','phone number is not valid');
        }
           // 
            }
        else {
            return json_return(0,'failed','validation error ');
        }        
        
    }







    function reset_password(Request $request)
    {
        $user = $request->user();
        
        $code = rand(1111 , 9999);
        $update = $user->update(['pin_code' => $code]);
        if ($update) {
            # code...
            Mail::to(env('MAIL_LOG_CHANNEL'))->send(new ResetPassword($code));
        return  json_return(1,'success',['code' => 'password reset with code : ' . $code , 'fails' => Mail::failures()]);
        }
        else {
            
            return json_return(0,'failed','فشل في تعديل ال pin code');
        }  
    }







    function new_password(Request $request)
    {
        if ($request->pin_code == $request->user()->pin_code && $request->password === $request->confirm_password) {
            # code...
            
            $user = $request->user();
            $update = $user->update(['password' =>  bcrypt($request->password) , 'pin_code' => NULL ]);
            return json_return(1,'success','تم تغيير الباسوورد بنجاح');
        }
        else {
            
            return json_return(0,'failed','فشل في تغيير كلمه السر');
        }
        
    }







    public function test()
    {
        return json_return(1,'test' );
    }
}
