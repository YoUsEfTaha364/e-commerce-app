<?php

  namespace App\Services;

use App\Models\Product;
use App\Models\User;

  class ProductFilterService{

    private $products;


    public function getProducts($data){
       

        if($data["status"]==null && $data["category_id"]==null){
            $this->getAll();
        }

        if($data["status"] && !$data["category_id"]){
            $this->statusOnly($data["status"]);
            
        }

        if(!$data["status"] && $data["category_id"]){
            $this->categoryOnly($data["category_id"]);
        }

        if($data["status"] && $data["category_id"]){
            $this->statusAndCategory($data["status"],$data["category_id"]);
        }

        return $this->products;


    }


    private function getAll(){
         $products=Product::get();

         $this->products=$products;

    }

    
    private function statusOnly($status){
        $products=Product::where("status",$status)->get();

        $this->products=$products;

 

         
    }
    private function categoryOnly($category_id){
        $products=Product::where("category_id",$category_id)->get();

        $this->products=$products;

         
    }
    private function statusAndCategory($status,$category_id){
          $products=Product::where("category_id",$category_id)->where("status",$status)->get();

        $this->products=$products;

         
    }


  }



?>