<?php

namespace App\Http\Controllers\Admin;

use App\Exports\TestExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Services\FileService;
use App\Services\ProductFilterService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller implements HasMiddleware
{

    protected $file;
    protected $filter;

public function __construct(FileService $file,ProductFilterService $filter)
{
    $this->file=$file;
    $this->filter=$filter;
}
 public static function middleware(): array
    {
        return [
            "c-auth",
            new Middleware("authorize-admin:products.create,products.edit,product.delete,products.view")
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter_data=[
            "status"=>$request->status,
            "category_id"=>$request->category,
        ];

        
        $products=$this->filter->getProducts($filter_data);
        // dump($products);
       
        return view("admin.products.index",compact("products","filter_data"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        


         $categories=Category::get();
        
        
         return view("admin.products.create",compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $product=Product::create([
            "name"=>$request->name,
            "description"=>$request->description,
            "price"=>$request->price,
            "sale_price"=>$request->sale_price,
            "quantity"=>$request->quantity,
            "status"=>$request->status,
            "category_id"=>$request->category_id,
        ]);




        // uploading image

        $newPath=$this->file->storeFile("image","products",$request);
        

        //  store image in db

        Image::create([
           "path"=>$newPath,
           "product_id"=>$product->id
        ]);


        return back()->with("add_product","Product Added Successfully");
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {


          return view("admin.products.show",compact("product"));
        
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view("admin.products.edit",compact("product"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        
       

       $product->fill($request->validated());


    
        if($request->hasFile("image")){
            // 1-delete old image from DB
            // Image::where("id",$product->images()->first()->id)->delete();
            //2-get new image path
            $newPath=$this->file->updateFile("image",$request,"products",$product);
            Image::updateOrCreate(["product_id"=>$product->id],[
                "path"=>$newPath,
                "product_id"=>$product->id
            ]);
            
            
        }

        $product->save();


        return redirect()->back()->with("update-prodcut","product updated successfully");


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function change_status(Product $product)
    {
        if($product->status=="active"){
            $product->status="inactive";
        }else{
            $product->status="active";

        }

        $product->save();
        
        return redirect()->back()->with("change-status","status changed successfully");

    }

      public function testExport()
    {
        return Excel::download(new TestExport, 'test.xlsx',null,["id","name"]);
    }
}
