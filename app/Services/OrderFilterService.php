<?php

  namespace App\Services;

use App\Models\Order;
use App\Models\User;

  class OrderFilterService{

    private $orders;


    public function getOrders($key=null){

        if($key==null){
            $this->getAll();
        }

        if($key=="latest"){
            $this->latestOrders();
        }

        if($key=="max_total"){
            $this->maxOrders();
        }

        if($key=="min_total"){
            $this->minOrders();
        }
        if($key=="paid_status"){
            $this->paidOrders();
        }

        return $this->orders;


    }

    private function maxOrders(){
        $orders=Order::orderBy("subtotal","desc")->get();

        $this->orders=$orders;

 

         
    }

    private function getAll(){
         $orders=Order::get();

         $this->orders=$orders;

    }
    private function latestOrders(){
        $orders=Order::orderBy("created_at","desc")->get();

        $this->orders=$orders;

         
    }
    private function minOrders(){
           $orders=Order::orderBy("subtotal","asc")->get();
  

        $this->orders=$orders;

         
    }
    private function paidOrders(){
           $orders=Order::where("payment_status","paid")->get();
  

        $this->orders=$orders;

         
    }


  }



?>