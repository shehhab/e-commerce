<?php

namespace App\Console\Commands\Initialization;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

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
        $admin = User::create([
            'name' => 'admin',
            'email'=> 'admin@admin.com',
            'password' => Hash::make('123456789'),

        ]);


    }

}
