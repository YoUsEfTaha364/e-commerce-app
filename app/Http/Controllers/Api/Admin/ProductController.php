<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\AddProductRequest;
use App\Http\Requests\Api\Admin\UpdateProductRequest;
use App\Models\Image;
use App\Models\Product;
use App\Services\api_response;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    protected $file;

    public function __construct(FileService $file)
    {
        $this->file = $file;
    }

    public function index()
    {

        $products = Product::get();

        if ($products->isEmpty()) {
            return api_response::Response(200, "no products found", []);
        }

        return api_response::Response(200, "get products", $products);
    }
    public function show(Request $request)
    {
        $user = $request->user();
        $id = $request->id;

        $product = Product::find($id);

        if (!$product) {
            return api_response::Response(404, " product not found", null);
        }



        return api_response::Response(200, "get product", $product);
    }
    public function store(AddProductRequest $request)
    {

        $validated = $request->validated();


        $product = null;

        DB::transaction(function () use ($validated, $request, &$product) {

            // 1️⃣ Create product
            $product = Product::create($validated);

            // 2️⃣ Store image if exists
            if ($request->hasFile('product_image')) {

                $path = $this->file->storeFile(
                    'product_image',
                    'products',
                    $request
                );

                Image::create([
                    'product_id' => $product->id,
                    'path'       => $path,
                ]);
            }
        });

        return api_response::Response(
            201,
            'Product created successfully',
            $product
        );
    }


    public function update(UpdateProductRequest $request, $id)
    {



        $product = Product::find($id);



        if (! $product) {
            return api_response::Response(404, 'Product not found', null);
        }

        $validated = $request->validated();

        $message   = [];

        DB::transaction(function () use ($product, $validated, $request, &$message) {

            // 1️⃣ Update product fields
            $product->fill($validated);

            if ($product->isDirty()) {
                $product->save();
                $message[] = 'Product fields updated';
            }

            // 2️⃣ Update image if exists
            if ($request->hasFile('product_image')) {

                $newPath = $this->file->updateFile(
                    'product_image',
                    $request,
                    'products',
                    $product
                );

                $image = $product->images()->first();

                if ($image) {
                    $image->update(['path' => $newPath]);
                } else {
                    Image::create([
                        'product_id' => $product->id,
                        'path'       => $newPath,
                    ]);
                }

                $message[] = 'Product image updated';
            }
        });

        return api_response::Response(
            200,


            $message,

            $product
        );
    }
}
