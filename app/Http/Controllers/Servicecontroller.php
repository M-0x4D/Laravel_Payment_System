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

           
            'receiver_id' => 'required', 
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
            $received_user = Client::where('id' , $request->receiver_id)->first();
            $received_user->update(['balance' => $received_user->balance + $request->amount]);
            $request->user()->transactions()->create([
                'sender_id' => $request->user()->id,
                'receiver_id' => $request->receiver_id , 
                'amount' => $request->amount ,
                'currency_id' => $request->currency_id ,
            ]);

           $currency = Currency::where('id' ,$request->currency_id )->first();
            return json_return(1 , 'success' , ' تم تحويل مبلغ'  . ' '. $request->amount . ' ' . $currency->name . ' '. 'الي العمل رقم ' . $request->receiver_id);
        }
        else {
            
            return json_return(0 , 'failed' , 'you have no enough balance ');
        }
    }
}
