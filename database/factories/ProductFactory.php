<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $product_type =['Sweater', 'Pants', 'Shirt', 'Glasses', 'Hat', 'Sockes'];
        $name =$this->faker->company. ' ' . Arr::random($product_type);
        return [
            // $table->string('name');
            //            $table->string('slug')->unique();
            //            $table->string('sku')->unique();
            //            $table->text("description");
            //            $table->integer("price")->default(0);
            //            $table->integer("weight")->default(0);
            //            $table->integer("stock")->default(0);
            //            $table->string("location");
            //            $table->boolean("status");
            //            $table->string("image")->default("public/assets/img/iphone-12-blue-select-2020.png");
            //            $table->boolean('featured')->default(false);
            //            $table->foreignIdFor(Tenant::class);
            //            $table->foreignIdFor(Category::class);
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->realText(320),
            'weight'=>$this->faker->numberBetween(1,10),
            'stock'=>$this->faker->numberBetween(100,1000),
            'location'=>$this->faker->numberBetween(100,1000),
            'sku'=>$this->faker->numberBetween(100,1000),
            'status'=>$this->faker->numberBetween(0,1),
            'image'=>$this->faker->image(),
            'price'=>$this->faker->numberBetween(100,1000),
            'tenant_id'=> $this->faker->numberBetween(1,2),
        ];
    }
}
