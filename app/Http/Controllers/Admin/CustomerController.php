<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\CustomerFilterService;

class CustomerController extends Controller
{
    public function index(CustomerFilterService $filter,$key=null)
    {
        $customers=$filter->getCustomers($key);

        return view("admin.customers.index", compact("customers","key"));
    }
    public function show(User $user)
    {
        return view("admin.customers.show", compact("user"));
    }
     public function filter(Request $request)
    {
    

        return redirect()->route("admin.customers.index",$request->sort);
    }
}
