<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Tenant::create([
            'name' =>'store-one',
            'domain' =>'store-one',
        ]);
        \App\Models\Tenant::create([
            'name' =>'store-two',
            'domain' =>'store-one',
        ]);
    }
}
