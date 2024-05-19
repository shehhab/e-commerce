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
        
  

    }

}
