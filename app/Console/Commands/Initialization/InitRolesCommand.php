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
        $Product1 = Product::create([
            'name' => 'hp 1',
            'price'=> '200',
            'description' => 'Writing compelling and unique storiesand descriptions of your products is never easy or swift -it takes time and effort that could be spent elsewhere. Meet Descra,a powerful product description generator which can help you create',
        ]);

        $imagePath1 = asset('product/2.png');

        $Product1->addMediaFromUrl($imagePath1)->toMediaCollection('product_image');
        
        $Product2 = Product::create([
            'name' => 'hp 2',
            'price'=> '500',
            'description' => 'unique stories and descriptions of your products is never easy or swift -it takes time and effort that could be spent elsewhere. Meet Descra, a powerful product description generator which can help you create',
        ]);

        $imagePath2 = asset('product/1.png');

        $Product2->addMediaFromUrl($imagePath2)->toMediaCollection('product_image');



        $Product3 = Product::create([
            'name' => 'hp 3',
            'price'=> '5200',
            'description' => 'and descriptions of your products is never easy or swift -it takes time and effort that could be spent elsewhere. Meet Descra,a powerful product description generator which can help you create',
        ]);

        $imagePath3 = asset('product/4.png');

        $Product3->addMediaFromUrl($imagePath3)->toMediaCollection('product_image');

        $Product4 = Product::create([
            'name' => 'hp 4',
            'price'=> '80000',
            'description' => 'and  of your  is never easy or swift -it takes time and effort that could be spent elsewhere. Meet Descra,a powerful product description generator which can help you create',
        ]);

        $imagePath4 = asset('product/3.png');

        $Product4->addMediaFromUrl($imagePath4)->toMediaCollection('product_image');

    }

}
