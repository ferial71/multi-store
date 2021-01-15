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
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->realText(320),
            'price'=>$this->faker->numberBetween(100,1000),
        ];
    }
}
