<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Tenant;
use App\Services\TenantManager;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(TenantSeeder::class);
        // \App\Models\User::factory(10)->create();
        Category::factory(10)->create();
        Product::factory(20)->create();

        $tenantManager = app(TenantManager::class);
        $tenants = Tenant::all();
        foreach ( $tenants as $tenant){

            $tenantManager->loadTenant($tenant->domain, null);
            $categories = Category::all();

            Product::all()->each(function ($product) use ($categories){
                $product->categories()->attach(
                    $categories->random(2)->pluck('id')->toArray()
                );

            });

        }
        // \App\Models\User::factory(10)->create();
    }
}
