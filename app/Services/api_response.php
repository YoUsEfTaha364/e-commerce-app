<?php
    namespace App\Services;
class api_response{


    public static function Response($code=200,$msg=null,$data=[]){

$response=[
    "status"=>$code,
    "message"=>$msg,
    "data"=>$data,
];

    return response()->json($response,$code);
    
}
}





?>