<?php
namespace App\Services;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

  class FileService{

      public function storeFile($input_name,$folder_name,$request){
         $file=$request->file($input_name);
        $currentName=$file->getClientOriginalName();
        $newName=time() . "_" . $currentName;
        $file-> storeAs($folder_name,$newName,"public");

         return $newName;
      }
      public function updateFile($input_name,$request,$folder_name,$old_model){
         
        // for updating
        /*
        1-get current path 
        2-delete it from storage
        3-get new path
        4-change to new path
        5-store in storage and DB 
        */
         if($old_model->images()->count() >0 && Storage::disk("public")->exists($folder_name."/".$old_model->images()->first()->path)){
           Storage::disk("public")->delete($folder_name."/".$old_model->images()->first()->path);

          }

          $file=$request->file($input_name);
          
         $currentName=$file->getClientOriginalName();
         $newName=time() . "_" . $currentName;
         
         $file->storeAs($folder_name,$newName,"public");

          return $newName;
      }

  }



?>