<?php


namespace App\Services;

use Exception;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Http;

class BasePaymentService{

    protected $base_url;
    protected array $header;

    protected function buildRequest($method,$url,$data=null,$type="json"){

        try{

        
        $response=Http::withHeaders($this->header)->send($method,$this->base_url . $url,[$type=>$data]);

        return response()->json([
            "success"=>$response->successful(),
            "status"=>$response->status(),
            "data"=>$response->json(),
        ],$response->status());
        }
        catch(Exception $e){
            return response()->json([
            "success"=>false,
            "status"=>500,
            "data"=>$e->getMessage(),
        ],500);    
        }

    }


}






