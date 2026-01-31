<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $files = glob(public_path('storage/products/*'), GLOB_BRACE);


// Pick one random file (full server path)
$randomFullPath = $files[array_rand($files)];

// Extract only the filename (e.g., "sunset.jpg")
$filenameOnly = basename($randomFullPath);

return [
    'path' => $filenameOnly,  // This saves only: sunset.jpg
    'product_id' => Product::inRandomOrder()->first()->id,
];
    }
}
