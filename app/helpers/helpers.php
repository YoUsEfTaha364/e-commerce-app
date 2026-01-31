<?php

use Illuminate\Support\Facades\Auth;

   function permission($perm){
      return Auth::guard("admin")->user()->hasAnyPermissions($perm) ? true : false;
   }




?>