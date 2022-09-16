<?php


use Illuminate\Support\Facades\Validator;


function returnjson($status,$msg , $data=null)
{

    $response = [
        "status" => $status,
        "msg" => $msg , 
        "data" => $data
    ];

    return response()->json($response);
}



function notifybyfirebase($title , $body , $tokens , $data=[])
{

    $registerationIds = $tokens;

    $fcmMsg = array(
        'body' => $body ,
        'title' => $title ,
        'sound' => 'default' , 
        'color' => '#203E78'
    );

    $fcmFields = array(
        'registeration_ids' => $registerationIds ,
        'periority' => 'high' , 
        'notification' => $fcmMsg ,
        'data' => $data
    );

    $headers = array(
        'Authorization: key='.env('FIREBASE_API_ACCESS_KEY') ,
        'content-type : application/json'        
    );

    $ch =  curl_init();
      // initializes a cURL session
    curl_setopt($ch , CURLOPT_URL  ,'firebase_link'); 
    curl_setopt($ch , CURLOPT_POST , true); 
    curl_setopt($ch , CURLOPT_HTTPHEADER , $headers); 
    curl_setopt($ch , CURLOPT_RETURNTRANSFER , true); 
    curl_setopt($ch , CURLOPT_SSL_VERIFYPEER , true);
    curl_setopt($ch , CURLOPT_POSTFIELDS , json_encode($fcmFields));    // changes the cURL session behavior with options
    $result = curl_exec($ch);      // executes the started cURL session
    curl_close($ch);  
    return $result;




}





function mohamed_validation()
{
    Validator::extend('phone_edit',function($attribute, $value, $parameters){
        //code that would validate
        if (strlen($value) == 12 && $value[0] == 0) {
            # code...
            return true;
           }
           else
           {
            return false;
    
           }
   });
}


?>