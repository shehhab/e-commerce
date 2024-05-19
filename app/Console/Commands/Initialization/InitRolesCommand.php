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
        
        $Product2 = Product::create([
            'name' => 'hp 2',
            'price'=> '500',
            'description' => 'unique stories and descriptions of your products is never easy or swift -it takes time and effort that could be spent elsewhere. Meet Descra, a powerful product description generator which can help you create',
        ]);

        $imagePath2 = asset('product/1.png');

        $Product2->addMediaFromUrl($imagePath2)->toMediaCollection('product_image');



    }

}
