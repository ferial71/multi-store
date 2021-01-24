<?php

use App\Models\Tenant;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('sku')->unique();
            $table->text("description");
            $table->integer("price")->default(0);
            $table->integer("weight")->default(0)->nullable();
            $table->integer("stock")->default(0);
            $table->string("location")->nullable();
            $table->boolean("status")->default(1);
            $table->string("image")->default("storage/iphone-12-blue-select-2020.png");
            $table->boolean('featured')->default(false);
            $table->foreignIdFor(Tenant::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
