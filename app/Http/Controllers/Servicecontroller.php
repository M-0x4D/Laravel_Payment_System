<?php

namespace App\Http\Controllers;

use App\models\Client;
use App\Models\Currency;
use Illuminate\Http\Request;

class Servicecontroller extends Controller
{
    //
    function transfare(Request $request)
    {
        $validator = validator()->make($request->all() , [

           
            'receiver_account_number' => 'required', 
            'amount' => 'required' ,
            'currency_id' => 'required'
        ]);
        if ($validator->fails()) {
            # code...
             return json_return(0 , 'failed' , 'validation error ');
        }

        if ($request->user()->balance >= $request->amount) {
            $sender_user = $request->user();

            $reduced_balance = $sender_user->balance - $request->amount;
            $sender_user->update(['balance' => $reduced_balance]);
            $received_user = Client::where('account_number' , $request->receiver_account_number)->first();
            $received_user->update(['balance' => $received_user->balance + $request->amount]);
            $request->user()->transactions()->create([
                'sender_account_number' => $request->user()->account_number,
                'receiver_account_number' => $request->receiver_account_number , 
                'amount' => $request->amount ,
                'currency_id' => $request->currency_id ,
            ]);

           $currency = Currency::where('id' ,$request->currency_id )->first();
            return json_return(1 , 'success' , ' تم تحويل مبلغ'  . ' '. $request->amount . ' ' . $currency->name . ' '. 'الي العمل رقم ' . $request->receiver_account_number);
        }
        else {
            
            return json_return(0 , 'failed' , 'you have no enough balance ');
        }
    }






    function transfare_gateway(Request $request)
    {
        $validator = validator()->make($request->all() , [

           'sender_account_number' => 'required' ,
            'receiver_account_number' => 'required', 
            'amount' => 'required' ,
            'currency_id' => 'required'
        ]);
        if ($validator->fails()) {
            
             return json_return(0 , 'failed' , 'payment validation error ');
        }

        $sender_user = Client::where('account_number' , $request->sender_account_number)->first();
        if ($sender_user->balance >= $request->amount) {
            

            $reduced_balance = $sender_user->balance - $request->amount;
            $sender_user->update(['balance' => $reduced_balance]);
            $received_user = Client::where('account_number' , $request->receiver_account_number)->first();
            $received_user->update(['balance' => $received_user->balance + $request->amount]);
            $sender_user->transactions()->create([
                'sender_account_number' => $request->sender_account_number,
                'receiver_account_number' => $request->receiver_account_number , 
                'amount' => $request->amount ,
                'currency_id' => $request->currency_id ,
            ]);

           $currency = Currency::where('id' ,$request->currency_id )->first();
            return json_return(1 , 'success' , ' تم تحويل مبلغ'  . ' '. $request->amount . ' ' . $currency->name . ' '. 'الي العميل '.$received_user->name . ' رقم ' . $request->receiver_account_number);
        }
        else {
            
            return json_return(0 , 'failed' , 'you have no enough balance ');
        }
    }
}
