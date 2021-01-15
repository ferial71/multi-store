<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->hasMany(User::class);
    }
    public function product()
    {
        return $this->hasMany(Product::class);
    }
    public function category()
    {
        return $this->hasMany(Category::class);
    }

    public function route($name, $parameters = []) {
        return 'https://' . $this->domain . app('url')->route($name, $parameters, false);
    }
}
