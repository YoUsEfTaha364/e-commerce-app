<?php

  namespace App\Services;

use App\Models\User;

  class CustomerFilterService{

    private $customers;


    public function getCustomers($key=null){

        if($key==null){
            $this->getAll();
        }

        if($key=="latest"){
            $this->latestCustomers();
        }

        if($key=="oldest"){
            $this->oldestCustomers();
        }

        if($key=="orders_count"){
            $this->mostOrdersCustomers();
        }

        return $this->customers;


    }

    private function oldestCustomers(){
        $customers=User::orderBy("created_at","asc")->get();

        $this->customers=$customers;

 

         
    }

    private function getAll(){
         $customers=User::get();

         $this->customers=$customers;

    }
    private function latestCustomers(){
        $customers=User::orderBy("created_at","desc")->get();

        $this->customers=$customers;

         
    }
    private function mostOrdersCustomers(){
           $customers=$users = User::query()
    ->withCount('orders')
    ->orderByDesc('orders_count')
    ->get();

        $this->customers=$customers;

         
    }


  }



?>