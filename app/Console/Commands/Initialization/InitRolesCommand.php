<?php

namespace App\Console\Commands\Initialization;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Console\Command;

class InitRolesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:init-roles-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Roles Initialize';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $products = [
            [
                'name' => 'hp 1',
                'price' => 200,
                'description' => 'Writing compelling and unique stories and descriptions of your products is never easy or swift - it takes time and effort that could be spent elsewhere. Meet Descra, a powerful product description generator which can help you create',
                'image' => 'product/2.png'
            ],
            [
                'name' => 'hp 2',
                'price' => 500,
                'description' => 'Unique stories and descriptions of your products is never easy or swift - it takes time and effort that could be spent elsewhere. Meet Descra, a powerful product description generator which can help you create',
                'image' => 'product/1.png'
            ],
            [
                'name' => 'hp 3',
                'price' => 5200,
                'description' => 'And descriptions of your products is never easy or swift - it takes time and effort that could be spent elsewhere. Meet Descra, a powerful product description generator which can help you create',
                'image' => 'product/4.png'
            ],
            [
                'name' => 'hp 4',
                'price' => 80000,
                'description' => 'And of your is never easy or swift - it takes time and effort that could be spent elsewhere. Meet Descra, a powerful product description generator which can help you create',
                'image' => 'product/3.png'
            ]
        ];

        foreach ($products as $productData) {
            $product = Product::create([
                'name' => $productData['name'],
                'price' => $productData['price'],
                'description' => $productData['description'],
            ]);

            $imageUrl = asset($productData['image']);
            if ($this->isValidUrl($imageUrl)) {
                try {
                    $product->addMediaFromUrl($imageUrl)->toMediaCollection('product_image');
                    $this->info("Added image for product: " . $productData['name']);
                } catch (\Exception $e) {
                    $this->error("Error adding image for product: " . $productData['name'] . ". Error: " . $e->getMessage());
                }
            } else {
                $this->error("Invalid URL for product: " . $productData['name']);
            }
        }
    }

    /**
     * Check if the URL is valid.
     */
    private function isValidUrl($url)
    {
        $headers = @get_headers($url);
        return $headers && strpos($headers[0], '200') !== false;
    }
}
